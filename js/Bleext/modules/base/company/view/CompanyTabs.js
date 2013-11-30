/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Ext.define("Bleext.modules.base.company.view.CompanyTabs", {
    extend: "Bleext.abstract.TabPanel",
    initComponent: function() {
        var me = this;

        Ext.apply(this, {
            xtype: 'plain-tabs',
            items: [{
                    title: 'Active Tab',
                    
                    
                }, {
                    title: 'Inactive Tab',
                    
                }, {
                    title: 'Disabled Tab',
                    disabled: true
                }]

        });
        me.callParent();

    }
});

