<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');
require_once('Utilities/WebUtil.php');

class ConfMenuTreeController extends GxController {

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('getactives'),
                'users' => array('@'),
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

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'ConfMenuTree'),
        ));
    }

    public function actionCreate() {
        $model = new ConfMenuTree;


        if (isset($_POST['ConfMenuTree'])) {
            $model->setAttributes($_POST['ConfMenuTree']);

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
        $model = $this->loadModel($id, 'ConfMenuTree');


        if (isset($_POST['ConfMenuTree'])) {
            $model->setAttributes($_POST['ConfMenuTree']);

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
            $this->loadModel($id, 'ConfMenuTree')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('ConfMenuTree');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new ConfMenuTree('search');
        $model->unsetAttributes();

        if (isset($_GET['ConfMenuTree']))
            $model->setAttributes($_GET['ConfMenuTree']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionGetActives() {
        $web = new WebUtil();

        $result = array(
            "text" => "Applications",
            "expanded" => true,
            "children" => $this->getTree(),
            "success" => TRUE
        );


        $web->sendResponse(200, CJSON::encode($result));
    }

    public function getTree() {

        $apps = ConfMenuTree::model()->findAll();

        $tree = $this->buildTree($apps, "children");

        return $tree->getRoot();
    }

    private function buildTree($apps, $text) {

        $temp = array();
        foreach ($apps as $app) {
            $iconCls = "";

            array_push($temp, array(
                "text" => $app["text"],
                "name" => $app["name"],
                "id" => $app["id"],
                "parent_id" => $app["parent_id"],
                "module" => $app["module"],
                "view" => $app["view"],
                "sort" => $app["sort"],
                "active" => $app["active"],
                "iconCls" => $app["iconCls"],
                "clickable" => $app["clickable"],
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
