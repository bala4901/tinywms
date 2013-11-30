/**
 * @class CRM.catalogs.users.view.Viewport
 * @extends CRM.abstract.Viewport
 * requires 
 * @autor Crysfel Villa
 * @date Mon Jul 25 23:20:56 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.wms.master.view.Viewport", {
    extend: "Bleext.abstract.ViewportWms",
    initComponent: function() {
        var me = this;

        this.items = this.buildItems();

        me.callParent();
    },
    buildItems: function() {

        var tree = Ext.create("Bleext.modules.wms.master.view.MenuTree", {
            region: "west",
            width: 200
        });

        var form = Ext.create("Bleext.modules.catalogs.applications.view.ApplicationForm", {
        });

        var ctrPanel = new Ext.Panel({
            items: [form],
        });

        var fitPanel = new Ext.Panel({
            layout: 'fit',
            region: 'center',
            items: ctrPanel
        })
        //return [tree,{layout: "border", region: "center", border: false, items: [form]}];
        return [tree, fitPanel];

    }
});
