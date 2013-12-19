/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define("Bleext.modules.wms.locmgmt.view.location.LocationGrid", {
    extend: "Bleext.abstract.Grid",
    store: "Bleext.modules.wms.locmgmt.store.Locations",
    title: "Location",
    border: false,
    split: true,
    editable: false,
    alias : 'widget.locationgrid',
    initComponent: function() {
        var me = this;

        this.tbar = this.buildSearchField();

        if (me.editable) {
            me.plugins = [Ext.create("Ext.grid.plugin.RowEditing")];
        }

        me.columns = [
            Ext.create('Ext.grid.RowNumberer'),
            {header: "Location No", dataIndex: "name", flex: 1, field: 'textfield'},
            {header: "Area", dataIndex: "area.name", flex: 1, field: 'textfield'},
            {header: "Warehouse", dataIndex: "warehouse.name", flex: 1, field: 'textfield'},
            {header: "Order", dataIndex: "sort", flex: 1, field: 'textfield'},
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
    }
});

