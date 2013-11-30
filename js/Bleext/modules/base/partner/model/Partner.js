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

Ext.define("Bleext.modules.base.partner.model.Partner", {
    extend: "Ext.data.Model",
    idProperty: "id",
    fields: [
        {name: "id"},
        {name: "name"},
        {name: "company_id"},
        {name: "create_uid"},
        {name: "create_date"},
        {name: "write_uid"},
        {name: "write_date"},
        {name: "comment"},
        {name: "active"},
        {name: "country_id"},
        {name: "lang"},
        {name: "parent_id"},
        {name: "title"},
        {name: "address"},
        {name: "address1"},
        {name: "phone"},
        {name: "mobile"},
        {name: "email"},
        {name: "website"},
        {name: "city"},
        {name: "fax"},
        {name: "zipcode"},
        {name: "customer"},
        {name: "supplier"},
        {name: "code"},
    ]

});