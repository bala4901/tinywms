/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define("Bleext.modules.wms.master.view.location.LocationForm", {
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
        
       
        me.callParent();
    }
});


