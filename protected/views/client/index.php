<script type="text/javascript">
    Ext.Loader.setPath({
        'Ext.ux.desktop': '<?php echo Yii::app()->request->baseUrl; ?>/js/app',
        MyDesktop: '<?php echo Yii::app()->request->baseUrl; ?>/js'
    });

    Ext.require('MyDesktop.App');

    var myDesktopApp;
    Ext.onReady(function() {
        myDesktopApp = new MyDesktop.App();
    });
</script> 