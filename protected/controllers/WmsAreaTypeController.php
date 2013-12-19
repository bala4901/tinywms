<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');

class WmsAreaTypeController extends GxController {

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view', 'getComboSelection'),
                'roles' => array('*'),
            ),
            array('allow',
                'actions' => array('minicreate', 'create', 'update'),
                'roles' => array('UserCreator'),
            ),
            array('allow',
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'WmsAreaType'),
        ));
    }

    public function actionCreate() {
        $model = new WmsAreaType;


        if (isset($_POST['WmsAreaType'])) {
            $model->setAttributes($_POST['WmsAreaType']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'WmsAreaType');


        if (isset($_POST['WmsAreaType'])) {
            $model->setAttributes($_POST['WmsAreaType']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'WmsAreaType')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('WmsAreaType');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new WmsAreaType('search');
        $model->unsetAttributes();

        if (isset($_GET['WmsAreaType']))
            $model->setAttributes($_GET['WmsAreaType']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data for filling the combo box
     * @return id, name
     */
    public function actionGetComboSelection() {

        $model = new WmsAreaType();
        $data = $model->getComboSelect();

        commons::dTrace($data);
        if (isset($data)) {
            WebUtil::sendResponse(200, CJSON::encode(array("data" => $data, "success" => TRUE, "message" => "Permissions successfully saved")));
        } else {
            WebUtil::sendResponse(200, CJSON::encode(array("data" => "", "success" => TRUE, "message" => "Permissions successfully saved")));
        }
    }

}
