/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define("Bleext.modules.wms.locmgmt.view.area.AreaGrid", {
    extend: "Bleext.abstract.Grid",
    store: "Bleext.modules.wms.locmgmt.store.Areas",
    title: "Partner",
    border: false,
    split: true,
    editable: false,
    alias : 'widget.areagrid',
    initComponent: function() {
        var me = this;

        this.tbar = this.buildSearchField();

        if (me.editable) {
            me.plugins = [Ext.create("Ext.grid.plugin.RowEditing")];
        }

        me.columns = [
            Ext.create('Ext.grid.RowNumberer'),
            {header: "Area Code", dataIndex: "area_code", flex: 1, field: 'textfield'},
            {header: "Name", dataIndex: "name", flex: 1, field: 'textfield'},
            {header: "Type", dataIndex: "areatype.name", flex: 1, field: 'textfield'},
            {header: "Warehouse", dataIndex: "warehouse.name", flex: 1, field: 'textfield'},
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

