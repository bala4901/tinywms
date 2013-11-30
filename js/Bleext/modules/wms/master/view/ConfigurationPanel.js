Ext.define('Bleext.modules.wms.master.view.ConfigurationPanel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.confpanel',
    requires: ['Bleext.modules.wms.master.view.area.AreaGrid',
        'Bleext.modules.wms.master.view.area.AreaForm'],
    frame: true,
    title: 'Company Data',
    bodyPadding: 5,
    layout: 'accordion', // Specifies that the items will now be arranged in columns


    items: [{
            xtype: 'areagrid',
           // columnWidth: .70
        }, {
            xtype: 'areaform',
          //  columnWidth: .30
        }]

});
