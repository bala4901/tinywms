/**
 * @class Bleext.modules.catalogs.users.controller.Users
 * @extends Ext.app.Controller
 * requires 
 * @autor Markus Bala
 * @date Sun Jul 17 19:00:53 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.base.company.controller.Company", {
    extend: "Bleext.abstract.Controller",
    views: [
        "Bleext.modules.base.company.view.Viewport",
        "Bleext.modules.base.company.view.CompanyForm",
        "Bleext.modules.base.company.view.CompaniesTree",
        "Bleext.modules.base.company.view.ConfigurationsGrid",
    ],
    stores: ["Bleext.modules.base.company.store.Company"],
    models: ["Bleext.modules.base.company.model.Company"],
    init: function() {
        this.callParent();

        this.control({
            "treepanel[itemId=companiesTree]": {
                itemclick: this.editApplication,
                itemmove: this.changeParent
            }
        });
    },
    add: function()
    {
        var form = this.win.down("form"),
                props = this.win.down("propertygrid"),
                tree = this.win.down("treepanel"),
                nodes = tree.getSelectionModel().getSelection();

        form.getForm().reset();
        if (!Ext.isEmpty(nodes)) {
            form.getForm().setValues({parent_id: nodes[0].get("parent_id")});
        }
        props.setSource({
            iconCls: "",
            width: Bleext.desktop.Constants.DEFAULT_WINDOW_WIDTH,
            height: Bleext.desktop.Constants.DEFAULT_WINDOW_HEIGHT,
            shorcutIconCls: ""
        });
    },
    export: function()
    {
 
    },
    save: function() {
        var form = this.win.down("form"),
                props = this.win.down("propertygrid"),
                params = form.getValues(),
                tree = this.win.down("treepanel");

        if (form.getForm().isValid()) {
            var obj = props.getSource();
            obj.singleton = params.singleton;
            params.configurations = Ext.encode(obj);
            delete params.singleton;

            Bleext.Ajax.request({
                url: Bleext.BASE_PATH + "index.php/rescompany/save",
                statusBar: this.win.statusBar,
                params: {data: Ext.encode(params)},
                success: function(data) {
                    tree.getStore().load();
                    form.getForm().setValues({id: data.id});
                }
            });
        } else {
            this.win.statusBar.setStatus({
                text: "There's a few error in the form, please make sure everything is fine",
                iconCls: 'x-status-error'
            });
        }
    },
    remove: function() {
        var tree = this.win.down("treepanel"),
                nodes = tree.getSelectionModel().getSelection();
        if (Ext.isEmpty(nodes)) {
            this.showError("You need to select an application to delete.");
            return false;
        }

        if (!Ext.isEmpty(nodes[0].childNodes)) {
            this.showError("You can't delete a company that contains the children.");
            return false;
        }

        Bleext.Msg.confirm("Are you sure you want to delete this company?", function(btn) {
            if (btn === "yes") {
                var form = this.win.down("form");

                Bleext.Ajax.request({
                    url: Bleext.BASE_PATH + "index.php/rescompany/deactivate",
                    params: {id: form.getForm().getValues().id},
                    statusBar: this.win.statusBar,
                    success: function(data) {
                        tree.getStore().load();
                        form.getForm().reset();
                    }
                });
            }
        }, this);
    },
    editApplication: function(tree, record) {
        var form = this.win.down("form"),
                configs = record.get("configurations") || "{}";

        configs = Ext.decode(configs);

        form.loadRecord(record);
    },
    changeParent: function(application, oldParent, newParent, index, options) {
        
        var tree = this.win.down("treepanel"),
                values = {
                    id: application.get("id"),
                    parent_id: options.get("id"),          
                };

        Bleext.Ajax.request({
            url: Bleext.BASE_PATH + "index.php/rescompany/move",
            params: {data: Ext.encode(values)},
            el: tree.el,
            statusBar: this.win.statusBar
        });
    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.base.company.view.Viewport"));
    }
});