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

Ext.define("Bleext.modules.wms.master.controller.Settings", {
    extend: "Bleext.abstract.Controller",
    views: [
    ],
    stores: ['Bleext.modules.wms.master.store.Menu', 'Bleext.modules.wms.master.store.Location'],
    models: ['Bleext.modules.wms.master.model.Menu'],
    init: function() {
        
        this.callParent();

        this.control({
            "treepanel[itemId=menuTree]": {
                itemclick: this.switchView,
            }
        });

    },
    add: function()
    {
console.log("setting");
    },
    export: function()
    {

    },
    save: function() {

    },
    remove: function() {

    },
    switchView: function(tree, record) {
        if (record.data.clickable <= 0) return;

        var view = Ext.create(record.data.view);
        var ctrPanel = this.getCentrePanel();

        ctrPanel.removeAll();

        ctrPanel.insert(0, view);
        ctrPanel.doLayout;
       // this.runAction('Bleext.modules.wms.master.controller.Location', 'Index', this.getCentrePanel());
    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.wms.master.view.Viewport"));
    },
    getCentrePanel: function()
    {
        return this.win.down("panel[region=center]");
    }
});