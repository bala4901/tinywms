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

Ext.define("Bleext.modules.wms.locmgmt.controller.Location", {
    extend: "Bleext.abstract.Controller",
    views: [
        'Bleext.modules.wms.locmgmt.view.location.LocationGrid',
        'Bleext.modules.wms.locmgmt.view.location.LocationForm'
    ],
    stores: ['Bleext.modules.wms.locmgmt.store.Locations'],
    models: ['Bleext.modules.wms.locmgmt.model.Location'],
    init: function() {
        this.callParent();

        this.control({
            'locationgrid': {
                itemdblclick: this.gridDblClick,
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
    getCentrePanel: function()
    {
        return this.win.down("panel[region=center]");
    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.wms.locmgmt.view.location.Viewport"));
    },
    gridDblClick: function(model, records) {
        console.log(records);

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