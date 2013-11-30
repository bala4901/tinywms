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

Ext.define("Bleext.modules.base.company.model.Company",{
	extend		: "Ext.data.Model",
	idProperty	: "id",
	fields		: [
		{name:"id",type:"integer"},
		{name:"name"},
                {name:"address"},
                {name:"address1"},
                {name:"phone"},
                {name:"website"},
                {name:"email"},
                {name:"fax"},
                {name:"zipcode"},
                {name:"city"},
                {name:"country_id"},
                {name:"parent_id"},
                {name:"company_id"},
                {name:"partner_id"},
                {name:"currency_id"},
                {name:"text"},
	]
	
});