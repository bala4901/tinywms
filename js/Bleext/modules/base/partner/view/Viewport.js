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

Ext.define("Bleext.modules.base.partner.view.Viewport", {
    extend: "Bleext.abstract.Viewport",
    initComponent: function() {
        var me = this;

        this.items = this.buildItems();

        me.callParent();
    },
    buildItems: function() {
        var form = Ext.create("Bleext.modules.base.partner.view.PartnerForm", {
            region: "east",
            collapsed: true
        });
        var grid = Ext.create("Bleext.modules.base.partner.view.PartnerGrid", {
            region: "center"
        });

        return [{layout: "border", region: "center", border: false, items: [grid,form]}];
    }
});
