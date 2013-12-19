<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');

//require_once('Utilities/WebUtil.php');

class RolesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'ext.starship.RestfullYii.filters.ERestFilter + 
            REST.GET, REST.PUT, REST.POST, REST.DELETE'
            ),
        );
    }

    public function actions() {
        return array(
            'REST.' => 'ext.starship.RestfullYii.actions.ERestActionProvider',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', 'actions' => array('REST.GET', 'REST.PUT', 'REST.POST', 'REST.DELETE'),
                'users' => array('*'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('GetRoleUsers', 'getusers'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $datas = json_decode($_POST["data"]);
        
        foreach ($datas as $var => $data) {
          //update
        if (strlen($data->role_k) > 0) {
            $retVal = Roles::model()->Write($data);
            
            WebUtil::sendResponse(200, NJSON::encode($retVal));
         
        } else { //create
            $retVal = Roles::model()->create($data);

            WebUtil::sendResponse(200, NJSON::encode($retVal));
        }
        }
        
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Roles'])) {
            $model->attributes = $_POST['Roles'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->role_k));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionList() {
        $web = new WebUtil();

        $model = Applications::model()->findAll();
        $web->sendResponse(500, CJSON::encode(array("success" => FALSE, $model)));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Roles']))
            $model->attributes = $_GET['Roles'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Roles the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Roles::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Roles $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'roles-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetRoleUsers() {
        $web = new WebUtil();
        $result = Roles::model()->getRolesUsers();

        $web->sendResponse(200, CJSON::encode(array("data" => $result, "success" => TRUE)));
    }

    public function actionGetUsers() {
        $web = new WebUtil();

        $limits = $this->getPageLimit(Yii::app()->request);
        $role_k = Yii::app()->request->getQuery("role_k", "0");


        $model = Roles::model()->getUsers($role_k, $limits);

        $web->sendResponse(200, CJSON::encode(array("data" => $model, "success" => TRUE)));
    }

}
