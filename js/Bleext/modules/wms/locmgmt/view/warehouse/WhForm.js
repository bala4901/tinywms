/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define("Bleext.modules.wms.locmgmt.view.warehouse.WhForm", {
    extend: "Bleext.abstract.Form",
    collapsible: true,
    split: true,
    title: "Details",
    iconCls: "bleext-gear-icon",
    border: false,
    autoScroll: true,
    alias: 'widget.whform',
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
                                items: [{
                                        fieldLabel: 'Wh Code',
                                        labelWidth: 110,
                                        allowBlank: false,
                                        name: 'code',
                                        emptyText: 'eg. John Berkshire',
                                    },
                                    {
                                        fieldLabel: 'Warehouse Name',
                                        labelWidth: 110,
                                        allowBlank: false,
                                        name: 'name',
                                        emptyText: 'eg. John Berkshire',
                                    },
                                    {
                                        xtype: 'combobox',
                                        name: 'company_id.name',
                                        forceSelection: true,
                                        listeners: {
                                            scope: this,
                                        },
                                        fieldLabel: 'Belong To',
                                        labelWidth: 110,
                                        width: 112,
                                        listConfig: {
                                            minWidth: null
                                        },
                                        store: Ext.create("Bleext.modules.base.company.store.Company", {
                                            url: "rescompany",
                                        }),
                                        valueField: 'id',
                                        displayField: 'name',
                                        typeAhead: true,
                                        queryMode: 'local',
                                    }
                                ]
                            }]
                    }]
            }
        });
        me.callParent();
    }
});


