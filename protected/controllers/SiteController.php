<?php
Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');
require_once('Utilities/WebUtil.php');

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }


    /**
     * Displays the login page
     */
    public function actionLogin() {
        // display the login form
        $this->render('login');
    }

    public function actionConfig() {
        $web = new WebUtil();
        
        $appModels = Applications::model()->getApplications(Yii::app()->user->user->username);

        $criteria = new CDbCriteria;
        $criteria->select = 't.user_k,t.username,t.email,t.name,t.lastname,t.avatar,t.active';
        $criteria->condition = 't.user_k = 1';
        $userModels = Users::model()->findAll($criteria);

        //$models = Applications::model()->findAll();
        if (empty($appModels)) {
            // No
            $web->sendResponse(200, 'No items where found for model <b>%s</b>');
        } else {
            // Prepare response
            $rows = array();
            foreach ($appModels as $model)
                $rows[] = $model->attributes;

            $outPut = array(
                "dock" => "bottom",
                "user" => $userModels,
                "config" => array(
                    "wallpaper" => "resources/wallpapers/blue2.jpg"
                ),
                "applications" => $this->buildTree($appModels, "menu"),
                "success" => TRUE,
            );
            // Send the response
            
            $web->sendResponse(200, CJSON::encode($outPut));
        }
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
        return $tree->getRoot();
    }

}