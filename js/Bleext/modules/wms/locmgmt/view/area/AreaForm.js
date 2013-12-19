/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define("Bleext.modules.wms.locmgmt.view.area.AreaForm", {
    extend: "Bleext.abstract.Form",
    collapsible: true,
    split: true,
    title: "Details",
    iconCls: "bleext-gear-icon",
    border: false,
    autoScroll: true,
    alias: 'widget.areaform',
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
                                xtype: "hidden",
                                name: "id"
                            },
                            {
                                xtype: "hidden",
                                name: "write_date"
                            },
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
                                        fieldLabel: 'Area Code',
                                        labelWidth: 110,
                                        allowBlank: false,
                                        name: 'area_code',
                                        maxLength: 6,
                                        enforceMaxLength: 6,
                                        emptyText: 'eg. 1001,100200',
                                    },
                                    {
                                        fieldLabel: 'Area Name',
                                        labelWidth: 110,
                                        allowBlank: false,
                                        name: 'name',
                                        emptyText: 'eg. Receiving Area, Sorting Area1',
                                    },
                                    {
                                        xtype: 'combobox',
                                        name: 'area_type_id',
                                        forceSelection: true,
                                        listeners: {
                                            scope: this,
                                        },
                                        fieldLabel: 'Area Type',
                                        labelWidth: 110,
                                        width: 112,
                                        listConfig: {
                                            minWidth: null
                                        },
                                        store: Ext.create("Bleext.abstract.ComboBoxStore", {
                                            url: "WmsAreaType/getcomboselection"
                                        }),
                                        valueField: 'id',
                                        displayField: 'name',
                                        typeAhead: true,
                                        queryMode: 'local',
                                    },
                                    {
                                        xtype: 'combobox',
                                        name: 'wh_id',
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
                                        store: Ext.create("Bleext.abstract.ComboBoxStore", {
                                            url: "wmswarehouse/getcomboselection"
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


