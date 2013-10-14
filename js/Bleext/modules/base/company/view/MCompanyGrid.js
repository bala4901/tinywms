/**
 * @class CRM.catalogs.users.view.UsersGrid
 * @extends Bleext.abstract.Grid
 * requires 
 * @autor Crysfel Villa
 * @date Mon Jul 25 23:24:12 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.base.company.view.MCompanyGrid", {
    extend: "Bleext.abstract.Grid",
    stores: ["Bleext.modules.base.company.store.MCompany"],
    models: ["Bleext.modules.base.company.model.MCompany"],
    title: "Companies",
    border: false,
    split: true,
    collapsible: true,
    editable: true,
    emptyText		: "No roles found",
    initComponent: function() {
        var me = this;

        if (me.editable) {
            me.plugins = [Ext.create("Ext.grid.plugin.RowEditing")];
        }

        me.columns = [
            {header: "Name", dataIndex: "name", flex: 1, field: "textfield"}
        ];

        if (me.full) {
            me.columns.push(
                    {header: "Description", dataIndex: "company_code", flex: 1, field: "textfield"}
            );
        }

        me.callParent();
    }
});