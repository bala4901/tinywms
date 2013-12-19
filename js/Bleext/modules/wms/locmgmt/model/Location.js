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

Ext.define("Bleext.modules.wms.locmgmt.model.Location", {
    extend: "Bleext.abstract.Model",
    fields: [
        {name: "location_code"},
        {name: "area_id"},
        {name: "wh_id"},
        {name: "warehouse"},
        {name: "warehouse.name"},
        {name: "area"},
        {name: "area.name"},
        {name: "sort"},
    ]

});