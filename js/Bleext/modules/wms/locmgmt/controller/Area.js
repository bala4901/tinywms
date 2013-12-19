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

Ext.define("Bleext.modules.wms.locmgmt.controller.Area", {
    extend: "Bleext.abstract.Controller",
    views: [
        "Bleext.modules.wms.locmgmt.view.area.AreaForm",
        "Bleext.modules.wms.locmgmt.view.area.AreaGrid"
    ],
    stores: ['Bleext.modules.wms.locmgmt.store.Areas'],
    models: ['Bleext.modules.wms.locmgmt.model.Area'],
    init: function() {
        this.callParent();

        this.control({
            'areagrid': {
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

    },
    remove: function() {

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
    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.wms.locmgmt.view.area.Viewport"));
    }
});