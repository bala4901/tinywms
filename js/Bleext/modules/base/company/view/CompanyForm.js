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
                    xtype: "hidden",
                    name: "id"
                },
                {
                    xtype: "hidden",
                    name: "partner_id"
                },
                {
                    xtype: "hidden",
                    name: "write_date"
                },
                {
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
                        },
                        {
                            labelWidth: 110,
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
                            allowBlank: false,
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
                                }, {
                                    xtype: 'combobox',
                                    name: 'mailingState',
                                    forceSelection: true,
                                    maxLength: 2,
                                    enforceMaxLength: true,
                                    fieldLabel: 'State',
                                    labelWidth: 50,
                                    width: 112,
                                    listConfig: {
                                        minWidth: null
                                    },
                                    valueField: 'abbr',
                                    displayField: 'abbr',
                                    typeAhead: true,
                                    queryMode: 'local',
                                    allowBlank: true,
                                }, {
                                    xtype: 'textfield',
                                    fieldLabel: 'Postal Code',
                                    labelWidth: 80,
                                    name: 'zipcode',
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
                    items: [
                        {
                            labelWidth: 110,
                            fieldLabel: 'Phone',
                            name: 'phone',
                        },
                        {
                            labelWidth: 110,
                            fieldLabel: 'Fax',
                            name: 'fax',
                        },
                        {
                            labelWidth: 110,
                            fieldLabel: 'Email',
                            name: 'email',
                        },
                        {
                            labelWidth: 110,
                            fieldLabel: 'Website',
                            name: 'website',
                        },
                    ]
                }]
        });
        me.callParent();
    }
});


