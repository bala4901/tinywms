/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Ext.define("Bleext.abstract.Model", {
    extend: "Ext.data.Model",
    idProperty: "id",
    fields: [
        {name: "id"},
        {name: "name"},
        {name: "create_uid"},
        {name: "create_date"},
        {name: "write_uid"},
        {name: "write_date"},
        {name: "active"},
    ]

});