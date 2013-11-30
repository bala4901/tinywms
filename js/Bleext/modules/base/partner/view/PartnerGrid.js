/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define("Bleext.modules.base.partner.view.PartnerGrid", {
    extend: "Bleext.abstract.Grid",
    store: "Bleext.modules.base.partner.store.Partner",
    title: "Partner",
    border: false,
    split: true,
    collapsible: true,
    editable: false,
    alias : 'widget.partnergrid',
    initComponent: function() {
        var me = this;

        this.tbar = this.buildSearchField();

        if (me.editable) {
            me.plugins = [Ext.create("Ext.grid.plugin.RowEditing")];
        }

        me.columns = [
            Ext.create('Ext.grid.RowNumberer'),
            {header: "Code", dataIndex: "code", flex: 1, field: 'textfield'},
            {header: "Name", dataIndex: "name", flex: 1, field: 'textfield'},
            {header: "Email", dataIndex: "email", flex: 1, field: 'textfield'},
            {header: "Phone", dataIndex: "phone", flex: 1, field: 'textfield'},
            {header: "Mobile", dataIndex: "mobile", flex: 1, field: 'textfield'},
            {header: "Fax", dataIndex: "fax", flex: 1, field: 'textfield'},
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
            }, '-',{
                xtype: 'checkboxfield',
                width: 110,
                boxLabel: 'Customer',
                name: 'customer',
                inputValue: '1',
            },
            {
                width: 110,
                xtype: 'checkboxfield',
                boxLabel: 'Supplier',
                name: 'supplier',
                inputValue: '1',
            }];
    },
});

