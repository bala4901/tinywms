/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Ext.define("Bleext.modules.base.company.view.CompaniesTree",{
	extend		: "Bleext.abstract.Tree",
	
	itemId		: "companiesTree",
	title		: "Companies",
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
		
		me.store = Ext.create("Bleext.modules.base.company.store.Company");
		
		
		me.callParent();
	}
});