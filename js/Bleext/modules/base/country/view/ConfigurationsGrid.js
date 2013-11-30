/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define("Bleext.modules.base.company.view.ConfigurationsGrid",{
	extend		: "Ext.grid.property.Grid",
	
	itemId		: "configurations",
	title		: "Configurations",
	iconCls		: "bleext-gear-icon",
	split		: true,
	collapsible	: true,
	border		: false,
	autoScroll	: true,
	
	source		: {
		iconCls			: "",
		width			: Bleext.desktop.Constants.DEFAULT_WINDOW_WIDTH,
		height			: Bleext.desktop.Constants.DEFAULT_WINDOW_HEIGHT,
		shorcutIconCls	: ""
	}
});
