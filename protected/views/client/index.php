<script type="text/javascript">
    Ext.application({
    requires: ['Ext.container.Viewport'],
    name: 'AM',

    appFolder: '<?php echo Yii::app()->request->baseUrl; ?>/js/app',
    controllers: [
        'Users'
    ],


  launch: function() {
       
        Ext.create('Ext.container.Viewport', {
            layout: 'fit',
            items: [
                {
                    xtype: 'userlist'
                }
            ]
        });
   
    }
});
    </script>