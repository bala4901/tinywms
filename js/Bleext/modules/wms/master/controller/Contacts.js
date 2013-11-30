Ext.define('Bleext.modules.wms.master.controller.Contacts', {
    extend: 'Ext.app.Controller',

    stores: [
        'Contacts'
        ],

    views: [
        'ContactsGrid'
        ],

    refs: [
        {
        ref: 'grid',
        selector: '',
        xtype: 'contacts-grid',
        autoCreate: true}
    ],

    init: function(application) {
        if (this.inited) {
            return;
        }
        this.inited = true;

        this.control({
            'contacts-grid': {
                itemdblclick: function() {
                    alert('you double clicked an item in the contacts grid');
                }
            }
        });
    },

    actionIndex: function() {
        this.application.setMainView(this.getGrid());
    }
});