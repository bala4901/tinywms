Ext.define('Bleext.modules.wms.master.store.Contacts', {
    extend: 'Ext.data.Store',
    storeId: 'Contacts',
    fields: [
        'name',
        'phone'
        ],
    data: [
        {
        name: "neil",
        phone: "6045551212"},
    {
        name: "frank",
        phone: "6045551213"}
    ],
    autoLoad: true
});