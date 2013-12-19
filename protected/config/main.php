<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'tinyWMS',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.giix-components.*', // giix components
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'ext.giix-core', // giix generators
            ),
        ),
    ),
    'behaviors' => array(
        'onBeginRequest' => array(
            'class' => 'application.components.RequireLogin'
        )
    ),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=tinywms',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => false,
            'loginUrl' => array('site/login'),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => require(
            dirname(__FILE__) . '/../extensions/starship/restfullyii/config/routes.php'
            ),
        ),
        'i18n_db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../modules/i18n/data/i18n.sqlite',
        ),
        'i18n' => array(
            'class' => 'CDbMessageSource',
            'connectionID' => 'i18n_db',
            'sourceMessageTable' => 'yii_i18n_source_messages', // will not use Yii Core framework/i18n/CdbMessageSource.php public case sensitive attributes values.
            'translatedMessageTable' => 'yii_i18n_messages', // will not use Yii Core framework/i18n/CdbMessageSource.php public case sensitive attributes values.
        ),
        /*
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
         */
        // uncomment the following to use a MySQL database
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error,info, warning,trace',
                    'logFile' => 'application.log'
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'profile',
                    'categories' => 'system.db.CDbCommand.query',
                    'logFile' => 'db.log'
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'categories' => 'vardump',
                    'logFile' => 'debug.log'
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
// application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'params' => [
            'RestfullYii' => [
                'req.auth.user' => function($application_id, $username, $password) {
            return false;
        },
            ]
        ]
    ),

);

$modules_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR;
$handle = opendir($modules_dir);
while (false !== ($file = readdir($handle))) {
    if ($file != "." && $file != ".." && is_dir($modules_dir . $file)) {
        $config = CMap::mergeArray($config, require($modules_dir . $file . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php'));
    }
}
closedir($handle);
return $config;
