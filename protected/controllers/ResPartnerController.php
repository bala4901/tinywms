<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');
require_once('Utilities/WebUtil.php');

class ResPartnerController extends GxController {

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'ResPartner'),
        ));
    }

    public function actionCreate() {
        $model = new ResPartner;


        if (isset($_POST['ResPartner'])) {
            $model->setAttributes($_POST['ResPartner']);

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
        $model = $this->loadModel($id, 'ResPartner');


        if (isset($_POST['ResPartner'])) {
            $model->setAttributes($_POST['ResPartner']);

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
            $this->loadModel($id, 'ResPartner')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $web = new WebUtil();
        $result = ResPartner::model()->findAll();

        $web->sendResponse(200, CJSON::encode(array("data" => $result, "success" => TRUE)));
// Send the response

        
    }

    public function actionAdmin() {
        $model = new ResPartner('search');
        $model->unsetAttributes();

        if (isset($_GET['ResPartner']))
            $model->setAttributes($_GET['ResPartner']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}
