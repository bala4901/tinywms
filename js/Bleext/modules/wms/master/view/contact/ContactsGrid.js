Ext.define('Bleext.modules.wms.master.view.contact.ContactsGrid', {
    extend: 'Ext.grid.Panel',
    alias:'widget.contacts-grid',

    height: 250,
    width: 400,
    title: 'Contacts',
    store: 'Contacts',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            columns: [
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'name',
                    text: 'Name'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'phone',
                    text: 'Phone'
                }
            ],
            viewConfig: {

            }
        });

        me.callParent(arguments);
    }
});