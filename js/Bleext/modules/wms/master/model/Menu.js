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

Ext.define("Bleext.modules.wms.master.model.Menu", {
    extend: "Ext.data.Model",
    idProperty: "id",
    fields: [
        {name: "id", type: "int"},
        {name: "parent_id", type: "int"},
        "text",
        "name",
        {
            name: 'iconCls',
            type: 'string',
            
        },
        {name: "active", type: "boolean"},
        "module",
        "view",
        "clickable",
    ]

});