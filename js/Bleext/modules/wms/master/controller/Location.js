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

Ext.define("Bleext.modules.wms.master.controller.Location", {
    extend: "Bleext.abstract.Controller",
    views: [
    ],
    stores: ['Bleext.modules.wms.master.store.Location'],
    models: ['Bleext.modules.wms.master.model.Location'],
    init: function() {
        this.callParent();


    },
    add: function()
    {
        console.log("location");
    },
    export: function()
    {

    },
    save: function() {

    },
    remove: function() {

    },
    editApplication: function(tree, record) {

    },
    changeParent: function(application, oldParent, newParent, index, options) {


    },
    actionIndex: function(obj) {
        //if (record.data.clickable <= 0) return;
        var view = Ext.create("Bleext.modules.wms.master.view.location.LocationGrid");

        var ctrPanel = obj;

        ctrPanel.removeAll();

        ctrPanel.insert(0, view);
        ctrPanel.doLayout;

        //this.application.setMainView("Bleext.modules.wms.master.view.location.LocationGrid");
    },
    getCentrePanel: function()
    {
        return this.win.down("panel[region=center]");
    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.wms.master.view.location.Viewport"));
    },
});