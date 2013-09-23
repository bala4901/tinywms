<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/default/css/loading.css" type="text/css" media="screen" title="no title" charset="utf-8">
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Bleext/Bleext.js" type="text/javascript" charset="utf-8"></script>	
	<script type="text/javascript">
                Bleext.BASE_PATH = "<?php echo Yii::app()->request->baseUrl; ?>/";
	</script>

        
    </head>

    <body>


        <?php echo $content; ?>

    </body>
</html>
