<?php

Yii::import('application.vendor.*');
require_once('Utilities/WebUtil.php');

class LoginController extends Controller {

    
    public function actionLogout() {
        $this->render('logout');
    }

   

    public function actionValidate() {
 

        $identity = new UserIdentity($_POST["username"], $_POST["password"]);
        if ($identity->authenticate()) {
            Yii::app()->user->login($identity);

            $this->_sendResponse(200,CJSON::encode(array(
                "success" => true,
                "url" => "index.php/client"
            )));
        } else {
            $this->_sendResponse(200, CJSON::encode(array(
                "success" => false,
                "message" => $identity->errorMessage
            )));
        }

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