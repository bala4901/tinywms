/**
 * @class Bleext.modules.catalogs.applications.view.ApplicationsTree
 * @extends Bleext.abstract.Tree
 * requires 
 * @autor Crysfel Villa
 * @date Tue Aug  2 01:12:14 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.wms.master.view.MenuTree", {
    extend: "Bleext.abstract.Tree",
    itemId: "menuTree",
    title: "Settings",
    split: true,
    collapsible: true,
    border: false,
    multiSelect: false,
    rootVisible: false,
    full: true,
    alias : 'widget.menutree',
    viewConfig: {
    },
    initComponent: function() {
        var me = this;
        me.store =  me.store = Ext.create("Bleext.modules.wms.master.store.Menu");
        me.callParent();
    },
});