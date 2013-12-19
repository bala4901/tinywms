<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');
require_once('Utilities/WebUtil.php');

class ApplicationsController extends Controller {

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('getactives', 'saveapp'),
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

    public function actionSaveApp() {
        $web = new WebUtil();
        $form = json_decode($_POST["data"]);

        if (strlen($form->application_k) > 0) {
            
        } else {
            $id = Applications::model()->create($form);

            Permissions::model()->addPermissions($id, $form->name);

            $web->sendResponse(200, NJSON::encode(
                            array("success" => TRUE,
                                "application_k" => $id,
                                "message" => Yii::t('Hint', 'AppAddSuccess', array(), 'i18n'))));
        }
    }

    public function getTree() {

        $apps = Applications::model()->findAll(array('order'=>'sort'));

        $tree = $this->buildTree($apps, "children");

        return $tree->getRoot();
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
                "sort" => $app["sort"],
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
        return $tree;
    }

}
