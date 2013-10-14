/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


Ext.define("Bleext.modules.base.company.view.TestView",{
    extend: 'Ext.grid.Panel',
    alias: 'widget.TestsView',

    id: 'tests-view',
    title: 'Tests',
    emptyText: '',
    store: 'CompanyStore',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            viewConfig: {

            },
            columns: [
            ]
        });

        me.callParent(arguments);
    }

});