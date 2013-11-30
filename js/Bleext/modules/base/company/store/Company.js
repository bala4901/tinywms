/**
 * @class CRM.catalogs.users.store.Users
 * @extends Bleext.abstract.Store
 * requires 
 * @autor Crysfel Villa
 * @date Mon Jul 25 23:27:57 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.base.company.store.Company", {
    extend: "Bleext.abstract.TreeStore",
    model: "Bleext.modules.base.company.model.Company",
    url: "rescompany/loadTree",
    nodeParam: "id"
});