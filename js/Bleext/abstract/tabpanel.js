/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Ext.define("Bleext.abstract.TabPanel", {
    extend: 'Ext.tab.Panel',
    activeTab: 0,
    defaults: {
        bodyPadding: 10
    },
    
    initComponent: function() {
        this.callParent();
    }
});