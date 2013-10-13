<?php

Yii::import('application.vendor.*');
require_once('Utilities/WebUtil.php');

class PermissionsController extends Controller {

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
                'actions' => array('index', 'getByApplication', 'test'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'updatepermissions'),
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
        $model = new Permissions;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Permissions'])) {
            $model->attributes = $_POST['Permissions'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->permission_k));
        }

        $this->render('create', array(
            'model' => $model,
        ));
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

        if (isset($_POST['Permissions'])) {
            $model->attributes = $_POST['Permissions'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->permission_k));
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
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Permissions');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionTest() {
        $web = new WebUtil();
        $application_k = $_GET["application_k"];

        $r = Permissions::model()->getUserRoleAppPermission(array(
            "user_k" => Yii::app()->user->user->user_k,
            "application_k" => $application_k
        ));


// Send the response
        $web->sendResponse(200, CJSON::encode(array($r, "success" => TRUE)));
    }

    public function actionGetByApplication() {
        $web = new WebUtil();

        $application_k = Yii::app()->request->getQuery("application_k", "0");

        $rows = array();
        $appPermissions = Applications::model()->getApplicationPermission($application_k);
        $actives = RolePermissions::model()->getRolePermissions($application_k);

        foreach ($appPermissions as $permission) {
            array_push($rows, array(
                "permission_k" => $permission["permission_k"],
                "permission" => $permission["name"]
            ));
        }

        $result = array();
        foreach ($rows as $row) {
            foreach ($actives as $role) {
                if ($role["permission_k"] === $row["permission_k"]) {
                    $row["role_" . $role["role_k"]] = $role["value"];
                }
            }
            array_push($result, $row);
        }

// Send the response
        $web->sendResponse(200, CJSON::encode(array("data" => $result, "success" => TRUE)));
    }

    public function actionUpdatePermissions() {
        $permissions = json_decode($_POST["permissions"]);
        $web = new WebUtil();

        if (isset($permissions)) {
            foreach ($permissions as $p) {
                $roles = Roles::model()->getByPermissions($p->permission_k);

                foreach ($roles as $role) {
                    $rpModel = RolePermissions::model()->findByPk($role["role_permission_k"]);
                    $rpModel->delete();
                }
                foreach ($p as $key => $value) {

                    if (preg_match("/^role_/", $key)) {
                        $rolesPerm = new RolePermissions();

                        $rolesPerm->permission_k = $p->permission_k;
                        $rolesPerm->date_created = date("Y-m-d h:i:s");
                        $rolesPerm->role_k = substr($key, 5);
                        if ($value) {
                            $rolesPerm->value = 1;
                        } else {
                            $rolesPerm->value = 0;
                        }

                        $rolesPerm->save();
                    }
                }
            }
            $web->sendResponse(200, CJSON::encode(array("success" => TRUE, "message" => "Permissions successfully saved")));
        }

    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Permissions('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Permissions']))
            $model->attributes = $_GET['Permissions'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Permissions the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Permissions::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Permissions $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'permissions-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
