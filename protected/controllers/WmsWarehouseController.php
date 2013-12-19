<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');

//require_once('Utilities/WebUtil.php');

class WmsWarehouseController extends GxController {

//    public function filters() {
//        return array(
//            'accessControl',
//            'postOnly + delete', // we only allow deletion via POST request
//        );
//    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view', 'getComboSelection', 'delete'),
                'roles' => array('*'),
            ),
            array('allow',
                'actions' => array('minicreate', 'create', 'update'),
                'roles' => array('UserCreator'),
            ),
            array('allow',
                'actions' => array('admin'),
                'users' => array('admin'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'WmsWarehouse'),
        ));
    }

    public function actionCreate() {
        $web = new WebUtil();
        $form = json_decode($_POST["data"]);

        //update
        if (strlen($form->id) > 0) {
            $model = WmsWarehouse::model()->findByPk($form->id);

            if (isset($model)) {
                $data = $model->Write($form);
                $web->sendResponse(200, CJSON::encode($data));
            }
        } else { //create
            $model = new WmsWarehouse;
            $data = $model->Create($form);


            $web->sendResponse(200, CJSON::encode($data));
        }
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'WmsWarehouse');


        if (isset($_POST['WmsWarehouse'])) {
            $model->setAttributes($_POST['WmsWarehouse']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete() {
        $web = new WebUtil();
        $form = json_decode($_POST["data"]);

        //update
        if (strlen($form->id) > 0) {
            $model = WmsWarehouse::model()->findByPk($form->id);

            if (isset($model)) {
                $data = $model->Deactive($form->id);
                $web->sendResponse(200, CJSON::encode($data));
            }
        }
    }



    public function actionIndex() {
        $params = WebUtil::queryParams(Yii::app()->request);

        $model = new WmsWarehouse();
        $datas = $model->getActives($params);

        if (isset($datas["data"])) {
            WebUtil::sendResponse(200, NJSON::encode(array("data" => $datas["data"], "success" => TRUE, "message" => "Permissions successfully saved", "total" => $datas["total"])));
        } else {
            WebUtil::sendResponse(200, NJSON::encode(array("data" => "", "success" => TRUE, "message" => "Permissions successfully saved")));
        }
    }

    public function actionAdmin() {
        $model = new WmsWarehouse('search');
        $model->unsetAttributes();

        if (isset($_GET['WmsWarehouse']))
            $model->setAttributes($_GET['WmsWarehouse']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data for filling the combo box
     * @return id, name
     */
    public function actionGetComboSelection() {

        $model = new WmsWarehouse();
        $data = $model->getComboSelect();

        if (isset($data)) {
            WebUtil::sendResponse(200, CJSON::encode(array("data" => $data, "success" => TRUE, "message" => "Permissions successfully saved")));
        } else {
            WebUtil::sendResponse(200, CJSON::encode(array("data" => "", "success" => TRUE, "message" => "Permissions successfully saved")));
        }
    }

}
