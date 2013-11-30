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

Ext.define("Bleext.modules.base.country.model.Country",{
	extend		: "Ext.data.Model",
	idProperty	: "id",
	fields		: [
		{name:"id",type:"integer"},
		{name:"name"},
                {name:"create_uid"},
                {name:"create_date"},
                {name:"write_uid"},
                {name:"write_date"},
                {name:"currency_id"},
                {name:"code"},
                {name:"address_format"},
	]
	
});