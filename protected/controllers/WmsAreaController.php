<?php

class WmsAreaController extends GxController {

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
            'model' => $this->loadModel($id, 'WmsArea'),
        ));
    }

    public function actionCreate() {
        $model = new WmsArea;


        if (isset($_POST['WmsArea'])) {
            $model->setAttributes($_POST['WmsArea']);

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
        $model = $this->loadModel($id, 'WmsArea');


        if (isset($_POST['WmsArea'])) {
            $model->setAttributes($_POST['WmsArea']);

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
            $this->loadModel($id, 'WmsArea')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $params = WebUtil::queryParams(Yii::app()->request);

        $model = new WmsArea();
        $datas = $model->getLists($params);


        WebUtil::sendResponse(200, NJSON::encode(array("data" => $datas['data'], "success" => TRUE, "total" => $datas['total'])));
    }

    public function actionAdmin() {
        $model = new WmsArea('search');
        $model->unsetAttributes();

        if (isset($_GET['WmsArea']))
            $model->setAttributes($_GET['WmsArea']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data for filling the combo box
     * @return id, name
     */
    public function actionGetComboSelection() {

        $model = new WmsArea();
        $data = $model->getComboSelect();

        WebUtil::sendResponse(200, NJSON::encode(array("data" => $data, "success" => TRUE)));
       
    }

}
