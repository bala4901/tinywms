/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define("Bleext.modules.base.partner.view.PartnerForm", {
    extend: "Bleext.abstract.Form",
    collapsible: true,
    split: true,
    title: "Details",
    iconCls: "bleext-gear-icon",
    border: false,
    autoScroll: true,
    alias: 'widget.partnerform',
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
                                title: 'Partner',
                                defaultType: 'textfield',
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%',
                                    labelWidth: 110,
                                },
                                items: [{
                                        fieldLabel: 'Name',
                                        labelWidth: 110,
                                        allowBlank: false,
                                        name: 'name',
                                        emptyText: 'eg. John Berkshire',
                                    },
                                    {
                                        fieldLabel: 'Code',
                                        name: 'code',
                                        emptyText: 'eg. S001, C02456',
                                    },
                                    {
                                        fieldLabel: 'Position',
                                        name: 'title',
                                        emptyText: 'eg. Purchase, Director',
                                    },
                                    {
                                        xtype: 'container',
                                        defaultType: 'checkboxfield',
                                        layout: 'hbox',
                                        margin: '5 0 5 0',
                                        defaults: {
                                            anchor: '100%',
                                            labelWidth: 110,
                                        },
                                        items:
                                                [{
                                                        width: 115,
                                                        fieldLabel: '',
                                                        xtype: 'displayfield'

                                                    },
                                                    {
                                                        boxLabel: 'Customer',
                                                        name: 'customer',
                                                        inputValue: '1',
                                                    },
                                                    {
                                                        boxLabel: 'Supplier',
                                                        name: 'supplier',
                                                        inputValue: '1',
                                                    }
                                                ]
                                    },
                                ],
                            },
                            {
                                xtype: 'fieldset',
                                title: 'Mailing Address',
                                defaultType: 'textfield',
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%',
                                    labelWidth: 110,
                                },
                                items: [{
                                        fieldLabel: 'Street Address',
                                        name: 'address',
                                    },
                                    {
                                        fieldLabel: 'Street Address2',
                                        name: 'address1',
                                    },
                                    {
                                        xtype: 'combobox',
                                        name: 'country_id',
                                        forceSelection: true,
                                        listeners: {
                                            scope: this,
                                        },
                                        fieldLabel: 'Country',
                                        labelWidth: 110,
                                        width: 112,
                                        listConfig: {
                                            minWidth: null
                                        },
                                        store: Ext.create("Bleext.modules.base.country.store.Country", {
                                            url: "rescountry/loadall",
                                        }),
                                        valueField: 'id',
                                        displayField: 'name',
                                        typeAhead: true,
                                        queryMode: 'local',
                                    },
                                    {
                                        xtype: 'container',
                                        layout: 'hbox',
                                        margin: '0 0 5 0',
                                        items: [{
                                                labelWidth: 110,
                                                xtype: 'textfield',
                                                fieldLabel: 'City',
                                                name: 'city',
                                                flex: 1,
                                            }, {
                                                xtype: 'combobox',
                                                name: 'mailingState',
                                                forceSelection: true,
                                                maxLength: 2,
                                                enforceMaxLength: true,
                                                listeners: {
                                                    scope: this,
                                                    //change: this.onMailingAddrFieldChange
                                                },
                                                fieldLabel: 'State',
                                                labelWidth: 50,
                                                width: 112,
                                                //store: states,
                                                valueField: 'abbr',
                                                displayField: 'abbr',
                                                typeAhead: true,
                                                queryMode: 'local',
                                            }, {
                                                xtype: 'textfield',
                                                fieldLabel: 'Postal Code',
                                                labelWidth: 80,
                                                name: 'zipcode',
                                                width: 160,
                                                maxLength: 10,
                                                enforceMaxLength: true,
                                                maskRe: /[\d\-]/,
                                                regex: /^\d{5}(\-\d{4})?$/,
                                                regexText: 'Must be in the format xxxxx or xxxxx-xxxx'
                                            }]
                                    }]
                            },
                            {
                                xtype: 'fieldset',
                                title: 'Contact Information',
                                defaultType: 'textfield',
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%',
                                    labelWidth: 110,
                                },
                                items: [{
                                        fieldLabel: 'Phone',
                                        name: 'phone',
                                    },
                                    {
                                        fieldLabel: 'Mobile',
                                        name: 'mobile',
                                    },
                                    {
                                        fieldLabel: 'Fax',
                                        name: 'fax',
                                    },
                                    {
                                        fieldLabel: 'Email',
                                        name: 'email',
                                    },
                                    {
                                        fieldLabel: 'Website',
                                        name: 'website',
                                    },
                                ]
                            }]
                    }]
            }
        });
        me.callParent();
    }
});


