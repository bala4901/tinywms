Ext.define('Bleext.modules.wms.master.controller.Area.Viewport', {
    extend: 'Ext.app.Controller',

    init: function(application) {
        if (this.inited) {
            return;
        }
        this.inited = true;

        this.control({
            'viewport #contacts': {
                click: function() {
                    this.application.runAction('Contacts', 'Index');
                }
            },
           /* 'viewport #orders':{
                click:function(){
                    this.application.runAction('Orders', 'Index');
                }
            }*/
        });
    }
});