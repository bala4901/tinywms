/**
 * @class Bleext.modules.catalogs.users.controller.Users
 * @extends Ext.app.Controller
 * requires 
 * @autor Markus Bala
 * @date Sun Jul 17 19:00:53 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.wms.master.controller.Area", {
    extend: "Bleext.abstract.Controller",
    views: [

    ],
    stores: ['Bleext.modules.wms.master.store.Area'],
    models: ['Bleext.modules.wms.master.model.Area'],
    init: function() {
        this.callParent();


    },
    add: function()
    {
        
    },
    export: function()
    {
 
    },
    save: function() {
       
    },
    remove: function() {
        
    },
    editApplication: function(tree, record) {
      
    },
    changeParent: function(application, oldParent, newParent, index, options) {
        
        
    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.wms.master.view.area.Viewport"));
    }
});