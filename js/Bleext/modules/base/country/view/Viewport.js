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

Ext.define("Bleext.modules.base.company.view.Viewport", {
    extend: "Bleext.abstract.Viewport",
    initComponent: function() {
        var me = this;

        this.items = this.buildItems();

        me.callParent();
    },
    buildItems: function() {
        var propertyGrid = Ext.create("Bleext.modules.base.company.view.ConfigurationsGrid", {
            region: "east",
            width: 200,
            collapsed: true
        });
        var tree = Ext.create("Bleext.modules.base.company.view.CompanyTree", {
            region: "west",
            width: 200
        });

        var form = Ext.create("Bleext.modules.base.company.view.CompanyForm", {
            region: "center"
        });

        return [tree, {layout: "border", region: "center", border: false, items: [form, propertyGrid]}];
    }
});
