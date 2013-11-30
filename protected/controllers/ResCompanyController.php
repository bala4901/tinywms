<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');
require_once('Utilities/WebUtil.php');

class ResCompanyController extends Controller {

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
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'save', 'loadTree', 'move'),
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
        $model = new ResCompany;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['ResCompany'])) {
            $model->attributes = $_POST['ResCompany'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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

        if (isset($_POST['ResCompany'])) {
            $model->attributes = $_POST['ResCompany'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $web = new WebUtil();
//		$dataProvider=new CActiveDataProvider('ResCompany');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));

        $outPut = array(
            "dock" => "bottom",
            "config" => array(
                "wallpaper" => "resources/wallpapers/blue2.jpg"
            ),
            "applications" => 'aas',
            "success" => TRUE,
        );
// Send the response

        $web->sendResponse(200, CJSON::encode($outPut));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ResCompany('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ResCompany']))
            $model->attributes = $_GET['ResCompany'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ResCompany the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ResCompany::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ResCompany $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'res-company-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionSave() {
        $web = new WebUtil();
        $form = json_decode($_POST["data"]);

        if (strlen($form->id) > 0) {
            $model = ResCompany::model()->findByPk($form->id);
            $partnerModel = ResPartner::model()->findByPk($form->partner_id);

            if (isset($model)) {
                foreach ($form as $var => $value) {
                    // Does model have this attribute?
                    if ($model->hasAttribute($var)) {
                        $model->$var = $value;
                    }
                }
                if (isset($partnerModel)) {
                    foreach ($form as $var => $value) {
                        if ($var != 'id') {
                            // Does model have this attribute?
                            if ($partnerModel->hasAttribute($var)) {
                                $partnerModel->$var = $value;
                            }
                        }
                    }
                }
                // Try to save the model
                if ($model->save()) {
                    if ($partnerModel->save()) {
                        $web->sendResponse(200, CJSON::encode(array("success" => TRUE, "id" => $model->id, "message" => "Application successfully updated")));
                    }
                } else {

                    $web->sendResponse(200, CJSON::encode(array("success" => FALSE, "message" => "There was an error updating this application.")));
                }
            } else {
                $web->sendResponse(200, CJSON::encode(array("success" => FALSE, "message" => "The record could not be found.")));
            }
        } else {

            $rCompany = new ResCompany();
            $rParner = new ResPartner();

            foreach ($form as $var => $value) {
                if ($rCompany->hasAttribute($var)) {
                    $rCompany->$var = $value;
                }
            }
            $partner_id = $rParner->addCompanyPartner($form);

            $rCompany->partner_id = $partner_id;

            if ($rCompany->save()) {

                $id = Yii::app()->db->getLastInsertID();

                $web->sendResponse(200, CJSON::encode(
                                array("success" => TRUE,
                                    "application_k" => $id,
                                    "message" => "Application successfully saved")));
            } else {
                commons::dTrace($rCompany->getErrors());
                $web->sendResponse(200, CJSON::encode(
                                array("success" => FALSE,
                                    "message" => "There was an error saving this application.")));
            }
        }
    }

    public function actionMove() {
        $web = new WebUtil();

        $form = json_decode($_POST["data"]);

        if (strlen($form->id) > 0) {
            $model = ResCompany::model()->findByPk($form->id);
            if (isset($model)) {
                $model->parent_id = $form->parent_id;
                if ($model->save()) {
                    $web->sendResponse(200, CJSON::encode(array("success" => TRUE, "id" => $model->id, "message" => "Application successfully updated")));
                } else {
                    $web->sendResponse(200, CJSON::encode(array("success" => FALSE, "message" => "There was an error updating this application.")));
                }
            }
        }
    }

    public function actionLoadTree() {
        $web = new WebUtil();

        $result = array(
            "text" => "Companies",
            "expanded" => true,
            "children" => $this->getTree(),
            "success" => TRUE
        );


        $web->sendResponse(200, CJSON::encode($result));
    }

    public function getTree() {

        $apps = ResCompany::model()->with('partner')->findAll();

        $tree = $this->buildTree($apps, "children");

        return $tree->getRoot();
    }

    private function buildTree($apps, $text) {

        $temp = array();
        foreach ($apps as $app) {
            array_push($temp, array(
                "text" => $app["name"],
                "name" => $app["name"],
                "id" => $app["id"],
                "parent_id" => $app["parent_id"],
                "phone" => $app["partner"]["phone"],
                "website" => $app["partner"]["website"],
                "fax" => $app["partner"]["fax"],
                "email" => $app["partner"]["email"],
                "city" => $app["partner"]["city"],
                "country_id" => $app["partner"]["country_id"],
                "address" => $app["partner"]["address"],
                "address1" => $app["partner"]["address1"],
                "zipcode" => $app["partner"]["zipcode"],
                "partner_id" => $app["partner"]["id"],
            ));
        }

// Creating the Tree
        $tree = new TreeUtil();
        $tree->setChildProperty($text);
        $tree->setIdProperty("id");
        foreach ($temp as $app) {
            $tree->addChild($app, $app["parent_id"]);
        }
        return $tree;
    }

}
