/**
 * @class Bleext.modules.catalogs.users.controller.Users
 * @extends Ext.app.Controller
 * requires 
 * @autor Crysfel Villa
 * @date Sun Jul 17 19:00:53 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.base.company.controller.MCompany", {
    extend: "Bleext.abstract.Controller",
    views: [
        "Bleext.modules.base.company.view.Viewport",
        "Bleext.modules.base.company.view.MCompanyGrid",
    ],
    stores: ["Bleext.modules.base.company.store.MCompany"],
    models: ["Bleext.modules.base.company.model.MCompany"],
    init: function() {
        this.callParent();
    },
    add: function()
    {
        console.log("doremi");
    },
    export: function()
    {
        console.log("doremi");
    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.base.company.view.Viewport"));
    }
});