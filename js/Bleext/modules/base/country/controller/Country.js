/**
 * @class Bleext.modules.catalogs.users.controller.Users
 * @extends Ext.app.Controller
 * requires 
 * @autor Crysfel Villa
 * @date Sun Jul 17 19:00:53 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.base.company.controller.Company", {
    extend: "Bleext.abstract.Controller",

    stores: ["Bleext.modules.base.country.store.country"],
    models: ["Bleext.modules.base.country.model.country"],
    init: function() {
        this.callParent();
    },
    add: function()
    {
        console.log("doremi");
    },
    export: function()
    {
        console.log("doremi");
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
                    form.getForm().setValues({application_k: data.application_k});
                }
            });
        } else {
            this.win.statusBar.setStatus({
                text: "There's a few error in the form, please make sure everything is fine",
                iconCls: 'x-status-error'
            });
        }
    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.base.company.view.Viewport"));
    }
});