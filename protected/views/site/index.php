	<div id="loading-mask"></div>
	<div id="loading">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/default/images/loading.gif" width="120" height="120" alt="Loading..." />
		<p id="msg">Please wait: Loading styles...</p>
	</div>
	<div>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/Ext/resources/css/ext-all.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/default/css/bleextop.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/Ext/ux/statusbar/css/statusbar.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/default/css/modules.css" type="text/css" media="screen" title="no title" charset="utf-8">

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/default/css/icons.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<script type="text/javascript">document.getElementById('msg').innerHTML = 'Please wait: Loading ExtJS files';</script> 
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Ext/ext-all-dev.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Bleext/core/Ajax.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Bleext/core/Log.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Bleext/desktop/Constants.js" type="text/javascript" charset="utf-8"></script>
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Bleext/overrides/Ext.data.proxy.Ajax.js" type="text/javascript" charset="utf-8"></script>
	
	
	<script type="text/javascript">document.getElementById('msg').innerHTML = 'Please wait: Loading Bleext Desktop.';</script> 
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Bleext/startup/boot.js" type="text/javascript" charset="utf-8"></script>
	</div>