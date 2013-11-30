/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Ext.define("Bleext.modules.base.company.view.CompanyTree",{
	extend		: "Bleext.abstract.Tree",
	
	itemId		: "companyTree",
	title		: "Company",
	split		: true,
	collapsible	: true,
	border		: false,
	multiSelect	: false,
	rootVisible	: false,
	full		: true,
	viewConfig	: {
		plugins	: {
			ptype: "treeviewdragdrop"
		}
	},

	initComponent	: function() {
		var me = this;
		
		//me.store = Ext.create("Bleext.modules.base.company.store.Company");
		
		
		me.callParent();
	}
});