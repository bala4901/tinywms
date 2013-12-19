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

Ext.define("Bleext.modules.wms.locmgmt.controller.Warehouse", {
    extend: "Bleext.abstract.Controller",
    views: ['Bleext.modules.wms.locmgmt.view.warehouse.WhGrid',
        'Bleext.modules.wms.locmgmt.view.warehouse.WhForm'
    ],
    stores: ['Bleext.modules.wms.locmgmt.store.Warehouses'],
    models: ['Bleext.modules.wms.locmgmt.model.Warehouse'],
    init: function() {
        this.callParent();

        this.control({
            'whgrid': {
                itemdblclick: this.gridDblClick,
                viewready: this.onViewReady
            }
        });



    },
    add: function()
    {
        var formPanel = this.win.down("panel[region=east]");
        var form = this.win.down("form");

        form.getForm().reset();

        if (formPanel.collapsed)
        {
            formPanel.expand();
        }
    },
    export: function()
    {

    },
    save: function() {
        var formPanel = this.win.down("panel[region=east]");
        var form = this.win.down("form"),
                grid = this.win.down("grid"),
                params = form.getValues();

        if (form.getForm().isValid()) {
            Bleext.Ajax.request({
                url: Bleext.BASE_PATH + "index.php/wmswarehouse/create",
                statusBar: this.win.statusBar,
                params: {data: Ext.encode(params)},
                success: function(data) {
                    
                    formPanel.getForm().reset();

                    if (formPanel.expand)
                    {
                        formPanel.collapsed();
                    }
                    
                    grid.getStore().load();
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
        var form = this.win.down("form"),
                grid = this.win.down("grid"),
                params = form.getValues();

        if (form.getForm().isValid()) {
            Bleext.Ajax.request({
                url: Bleext.BASE_PATH + "index.php/wmswarehouse/delete",
                statusBar: this.win.statusBar,
                params: {data: Ext.encode(params)},
                success: function(data) {
                    grid.getStore().load();
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
    editApplication: function(tree, record) {

    },
    changeParent: function(application, oldParent, newParent, index, options) {


    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.wms.locmgmt.view.warehouse.Viewport"));
    },
    gridDblClick: function(model, records) {

        this.getFormPanel().expand();
        this.getFormPanel().getForm().loadRecord(records);
        //  }
    },
    onViewReady: function(grid) {
        // grid.getSelectionModel().select(0);
    },
    getFormPanel: function()
    {
        var fPanel = this.win.down("panel[region=east]");
        return fPanel;
    },
    getGridPanel: function()
    {
        var fPanel = this.win.down("panel[region=center]");
        return fPanel;
    }
});