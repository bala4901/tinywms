/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define("Bleext.modules.wms.locmgmt.view.warehouse.WhGrid", {
    extend: "Bleext.abstract.Grid",
    store: "Bleext.modules.wms.locmgmt.store.Warehouses",
    title: "Warehouse",
    border: false,
    split: true,
    collapsible: true,
    editable: false,
    alias : 'widget.whgrid',
    initComponent: function() {
        var me = this;

        this.tbar = this.buildSearchField();

        if (me.editable) {
            me.plugins = [Ext.create("Ext.grid.plugin.RowEditing")];
        }

        me.columns = [
            Ext.create('Ext.grid.RowNumberer'),
            {header: "Wh Code", dataIndex: "Code", flex: 1, field: 'textfield'},
            {header: "Warehouse", dataIndex: "name", flex: 1, field: 'textfield'},
            {header: "Company", dataIndex: "company_id.name", flex: 1, field: 'textfield'},
        ];

        me.callParent();

    },
    buildSearchField: function() {
        return ['Search', {
                xtype: 'textfield',
                name: 'searchField',
                hideLabel: true,
                width: 200,
                align: 'right'
            }];
    },
});

