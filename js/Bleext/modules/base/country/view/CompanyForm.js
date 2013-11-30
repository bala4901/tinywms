/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define("Bleext.modules.base.company.view.CompanyForm", {
    extend: "Bleext.abstract.Form",
    initComponent: function() {
        var me = this;
        Ext.apply(this, {
            width: 550,
            fieldDefaults: {
                labelAlign: 'right',
                labelWidth: 90,
                msgTarget: 'qtip'
            },
            items: [{
                    xtype: 'fieldset',
                    title: 'Company',
                    defaultType: 'textfield',
                    layout: 'anchor',
                    defaults: {
                        anchor: '100%'
                    },
                    items: [{
                            xtype: 'fieldcontainer',
                            fieldLabel: 'Company Name',
                            layout: 'hbox',
                            combineErrors: true,
                            defaultType: 'textfield',
                            defaults: {
                                hideLabel: 'true'
                            },
                            items: [{
                                    name: 'name',
                                    fieldLabel: 'Company Name',
                                    flex: 2,
                                    emptyText: 'Company Name',
                                    allowBlank: false
                                }]
                        }],
                },
                {
                    xtype: 'fieldset',
                    title: 'Mailing Address',
                    defaultType: 'textfield',
                    layout: 'anchor',
                    defaults: {
                        anchor: '100%'
                    },
                    items: [{
                            labelWidth: 110,
                            fieldLabel: 'Street Address',
                            name: 'address',
                            listeners: {
                                scope: this,
                                //change: this.onMailingAddrFieldChange
                            },
                            allowBlank: false
                        },
                        {
                            labelWidth: 110,
                            fieldLabel: 'Street Address2',
                            name: 'address1',
                            listeners: {
                                scope: this,
                                //change: this.onMailingAddrFieldChange
                            },
                            allowBlank: false
                        },
                        {
                            xtype: 'combobox',
                            name: 'mailingState',
                            forceSelection: true,
                            maxLength: 2,
                            enforceMaxLength: true,
                            listeners: {
                                scope: this,
                                //change: this.onMailingAddrFieldChange
                            },
                            fieldLabel: 'Country',
                            labelWidth: 110,
                            width: 112,
                            listConfig: {
                                minWidth: null
                            },
                            //store: states,
                            valueField: 'abbr',
                            displayField: 'abbr',
                            typeAhead: true,
                            queryMode: 'local',
                            allowBlank: true,
                            forceSelection: true
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
                                    listeners: {
                                        scope: this,
                                        //change: this.onMailingAddrFieldChange
                                    },
                                    flex: 1,
                                    allowBlank: false
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
                                    listConfig: {
                                        minWidth: null
                                    },
                                    //store: states,
                                    valueField: 'abbr',
                                    displayField: 'abbr',
                                    typeAhead: true,
                                    queryMode: 'local',
                                    allowBlank: true,
                                    forceSelection: true
                                }, {
                                    xtype: 'textfield',
                                    fieldLabel: 'Postal Code',
                                    labelWidth: 80,
                                    name: 'zipcode',
                                    listeners: {
                                        scope: this,
                                        //change: this.onMailingAddrFieldChange
                                    },
                                    width: 160,
                                    allowBlank: false,
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
                        anchor: '100%'
                    },
                    items: [{
                            labelWidth: 110,
                            fieldLabel: 'Phone',
                            name: 'phone',
                            listeners: {
                                scope: this,
                                //change: this.onMailingAddrFieldChange
                            },
                            allowBlank: false
                        },
                        {
                            labelWidth: 110,
                            fieldLabel: 'Fax',
                            name: 'fax',
                            listeners: {
                                scope: this,
                                //change: this.onMailingAddrFieldChange
                            },
                            allowBlank: false
                        },
                        {
                            labelWidth: 110,
                            fieldLabel: 'Email',
                            name: 'email',
                            listeners: {
                                scope: this,
                                //change: this.onMailingAddrFieldChange
                            },
                            allowBlank: false
                        },
                        {
                            labelWidth: 110,
                            fieldLabel: 'Website',
                            name: 'website',
                            listeners: {
                                scope: this,
                                //change: this.onMailingAddrFieldChange
                            },
                            allowBlank: false
                        },
                    ]
                }]
        });
        me.callParent();
    }
});


