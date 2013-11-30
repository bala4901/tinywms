/**
 * @class Bleext.modules.catalogs.users.controller.Users
 * @extends Ext.app.Controller
 * requires 
 * @autor Crysfel Villa
 * @date Sun Jul 17 19:00:53 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("Bleext.modules.base.partner.controller.Partner", {
    extend: "Bleext.abstract.Controller",
    stores: ["Bleext.modules.base.partner.store.Partner"],
    models: ["Bleext.modules.base.partner.model.Partner"],
    views: ["Bleext.modules.base.partner.view.PartnerForm", "Bleext.modules.base.partner.view.PartnerGrid"],
    refs: [{
            ref: 'partnerForm',
            selector: 'form'
        }],
    init: function() {
        this.callParent();

        this.control({
            'partnergrid': {
                selectionchange: this.gridSelectionChange,
                viewready: this.onViewReady
            }
        });
    },
    add: function()
    {
        var formPanel = this.win.down("panel[region=east]");
        var form = this.win.down("form");

        form.getForm().reset();

        if (formPanel.collapsed)
        {
            formPanel.expand();
        }

        console.log("doremi");
    },
    export: function()
    {
        console.log("doremi");
    },
    save: function() {

    },
    setViewport: function() {
        this.win.add(Ext.create("Bleext.modules.base.partner.view.Viewport"));
    },
    gridSelectionChange: function(model, records) {

        if (records[0]) {
            this.getFormPanel().expand();
            this.getPartnerForm().getForm().loadRecord(records[0]);
        }
    },
    onViewReady: function(grid) {
        grid.getSelectionModel().select(0);
    },
    getPartnerForm: function()
    {
        var form = this.win.down("form");
        return form;
    },
    getPartnerGrid: function()
    {
        var grid = this.win.down("grid");
        return grid;
    }
    ,
    getFormPanel: function()
    {
        var fPanel = this.win.down("panel[region=east]");
        return fPanel;
    },
    getGridPanel: function()
    {
        var fPanel = this.win.down("panel[region=center]");
        return fPanel;
    }

});