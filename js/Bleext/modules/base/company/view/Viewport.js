/**
 * @class CRM.catalogs.users.view.Viewport
 * @extends CRM.abstract.Viewport
 * requires 
 * @autor Crysfel Villa
 * @date Mon Jul 25 23:20:56 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.base.company.view.Viewport",{
	extend		: "Bleext.abstract.Viewport",
	
	buildItems		: function(){
		var grid = Ext.create("Bleext.modules.base.company.view.MCompanyGrid",{
			region	: "center",
			
		});
		

		return [grid];
	}
});
