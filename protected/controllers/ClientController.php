<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');

class ClientController extends Controller {

    private $format = 'json';

    public function actionIndex() {
        $this->render('index');
    }

    public function actionFilter() {
        $this->render('filter');
    }

    public function actionLoadModule() {
        $this->render('loadModule');
    }

    public function actionLoadPreference() {
        $this->render('loadPreference');
    }

    public function actionConfig() {
        //$this->load->library("applicationbi");

        $appModels = Applications::model()->getApplications("crysfel");

        $criteria = new CDbCriteria;
        $criteria->select = 't.user_k,t.username,t.email,t.name,t.lastname,t.avatar,t.active';
        $criteria->condition = 't.user_k = 1';
        $userModels = Users::model()->findAll($criteria);

        //$models = Applications::model()->findAll();
        if (empty($appModels)) {
            // No
            $this->_sendResponse(200, sprintf('No items where found for model <b>%s</b>', $_GET['model']));
        } else {
            // Prepare response
            $rows = array();
            foreach ($appModels as $model)
                $rows[] = $model->attributes;

            $outPut = array(
                "dock" => "bottom",
                "user" => $userModels,
                "config" => array(
                    "wallpaper" => "resources/wallpapers/blue2.jpg"
                ),
                "applications" => $this->buildTree($appModels, "menu"),
                "success" => TRUE,
            );
            // Send the response
            $this->_sendResponse(200, CJSON::encode($outPut));
        }
    }

    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html') {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if ($body != '') {
            // send the body
            echo $body;
        }
        // we need to create the body if none is passed
        else {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on 
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templated in a real-world solution
            $body = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
</head>
<body>
    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    <p>' . $message . '</p>
    <hr />
    <address>' . $signature . '</address>
</body>
</html>';

            echo $body;
        }
        Yii::app()->end();
    }

    private function _getStatusCodeMessage($status) {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    private function buildTree($apps, $text) {

        $temp = array();
        foreach ($apps as $app) {
            $iconCls = "";
            if ($app["configurations"]) {
                $conf = json_decode($app["configurations"]);
                if ($conf) {
                    if (property_exists($conf, "iconCls")) {
                        $iconCls = $conf->iconCls;
                    }
                }
            }
            array_push($temp, array(
                "text" => $app["name"],
                "name" => $app["name"],
                "application_k" => $app["application_k"],
                "application_parent_k" => $app["application_parent_k"],
                "klass" => $app["klass"],
                "description" => $app["description"],
                "configurations" => $app["configurations"],
                "active" => $app["active"],
                "iconCls" => $iconCls,
            ));
        }

        // Creating the Tree
        $tree = new TreeUtil();
        $tree->setChildProperty($text);
        $tree->setIdProperty("application_k");
        foreach ($temp as $app) {
            $tree->addChild($app, $app["application_parent_k"]);
        }
        return $tree->getRoot();
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}