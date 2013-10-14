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

Ext.define("Bleext.modules.base.company.controller.MCompany", {
    extend: "Bleext.abstract.Controller",
    views: [
        "Bleext.modules.base.company.view.Viewport",
        "Bleext.modules.base.company.view.MCompanyGrid",
    ],
    stores: ["Bleext.modules.base.company.store.MCompany"],
    models: ["Bleext.modules.base.company.model.MCompany"],
    init: function(app) {
        this.win.add(Ext.create("Bleext.modules.base.company.view.Viewport"));

        this.control({
            "#MCompany button[action=new]": {
                click: this.addComp
            },
            "#MCompany button[action=save]": {
                click: this.saveComp
            },
            "#MCompany button[action=delete]": {
                click: this.deleteComp
            }

        });
    },
    addComp: function() {
        var grid = this.win.down("panel[region=center]"),
                store = grid.getStore();

        store.insert(0, {});
        grid.editingPlugin.startEdit(0, 0);
    },
    saveComp: function() {
        var grid = this.win.down("panel[region=center]"),
                store = grid.getStore(),
                records = Ext.Array.merge(store.getNewRecords(), store.getUpdatedRecords()),
                data = [];

        Ext.each(records, function(rec, i) {
            data.push(rec.data);
        });

        Bleext.Ajax.request({
            url: Bleext.BASE_PATH + "index.php/base/company/savecomp",
            params: {roles: Ext.encode(data)},
            el: this.win.el,
            success: function(info, options) {
                Ext.Msg.alert("Mensaje", info.message);
                store.load();
            },
            failure: function(info) {
                Bleext.log(info);
                Ext.Msg.alert("Error", "No se guardaron los roles!");
            }
        });
    },
    deleteComp: function() {
        var grid = this.win.down("panel[region=center]"),
                store = grid.getStore(),
                sm = grid.getSelectionModel();

        if (sm.hasSelection()) {
            Ext.Msg.confirm(
                    "Confirmación",
                    "Estás seguro de querer borrar estos registros?",
                    function(btn) {
                        if (btn === "yes") {
                            var records = sm.getSelection(), //tomar los resocords seleccionados
                                    data = [];

                            Ext.each(records, function(rec) {
                                if (!rec.phantom) {
                                    //capturar los registros que si existen en el servidor
                                    data.push(rec.data);
                                }
                            });//end each

                            //enviar al servidor para ser borrados
                            Bleext.Ajax.request({
                                url: Bleext.BASE_PATH + "index.php/base/company/deleteComp",
                                params: {roles: Ext.encode(data)},
                                success: function(info) {
                                    Bleext.Msg.info(info.message);
                                },
                                failure: function(info) {
                                    Bleext.Msg.error(info.message);
                                    store.load();
                                }
                            });

                            //eliminar todos los records seleccionados
                            store.remove(records);


                        }
                    }
            );
        }
    }
});