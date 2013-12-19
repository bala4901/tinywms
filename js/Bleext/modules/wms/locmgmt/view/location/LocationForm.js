/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define("Bleext.modules.wms.locmgmt.view.location.LocationForm", {
    extend: "Bleext.abstract.Form",
    collapsible: true,
    split: true,
    title: "Details",
    iconCls: "bleext-gear-icon",
    border: false,
    autoScroll: true,
    alias: 'widget.locform',
    initComponent: function() {
        var me = this;

        Ext.apply(this, {
            width: 550,
            fieldDefaults: {
                labelAlign: 'right',
                labelWidth: 90,
                msgTarget: 'qtip'
            },
            items: {
                xtype: 'tabpanel',
                activeTab: 0,
                defaults: {
                    bodyPadding: 10,
                    layout: 'anchor'
                },
                items: [{
                        //Basic Tab
                        title: 'Basic',
                        items: [
                            {
                                xtype: 'fieldset',
                                title: 'General',
                                defaultType: 'textfield',
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%',
                                    labelWidth: 110,
                                },
                                items: [
                                    {
                                        xtype: "hidden",
                                        name: "id"
                                    },
                                    {
                                        xtype: "hidden",
                                        name: "write_date"
                                    },
                                    {
                                        fieldLabel: 'Location No',
                                        labelWidth: 110,
                                        allowBlank: false,
                                        name: 'name',
                                        emptyText: 'eg.01-02-01, 01-003-004',
                                    },
                                    {
                                        fieldLabel: 'Order',
                                        labelWidth: 110,
                                        allowBlank: false,
                                        name: 'sort',
                                        emptyText: 'eg: 1,2,3,..1001',
                                    },
                                    {
                                        xtype: 'combobox',
                                        name: 'area_id',
                                        forceSelection: true,
                                        fieldLabel: 'Area',
                                        labelWidth: 110,
                                        width: 112,
                                        store: Ext.create("Bleext.abstract.ComboBoxStore", {
                                            url: "wmsarea/getcomboselection"
                                        }),
                                        valueField: 'id',
                                        displayField: 'name',
                                    }
                                ]
                            }]
                    }]
            }
        });

        me.callParent();
    }
});


