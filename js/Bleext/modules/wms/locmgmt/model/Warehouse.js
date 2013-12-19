/**
 * @class CRM.catalogs.users.model.User
 * @extends Ext.data.Model
 * requires 
 * @autor Markus Bala
 * @date Mon Oct 14 14:43:20 CDT 2013
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.wms.locmgmt.model.Warehouse", {
    extend: "Bleext.abstract.Model",
    fields: [
        {name: "wh_code"},
        {name: "company_id"},
        {name: "company"},
        {name: "company.name"},
    ]

});