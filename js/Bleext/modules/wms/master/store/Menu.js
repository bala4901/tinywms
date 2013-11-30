/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define("Bleext.modules.wms.master.store.Menu", {
    extend: "Bleext.abstract.TreeStore",
    model: "Bleext.modules.wms.master.model.Menu",
    url: "confmenutree/getactives",
    nodeParam: "id",
    params: {menuname: 'wms'},
});


