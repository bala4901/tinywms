<?php

Yii::import('application.vendor.*');
require_once('Utilities/TreeUtil.php');
require_once('Utilities/WebUtil.php');

class MCompanyController extends Controller {

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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('getcompanies'),
                'users' => array('@'),
            ),
        );
    }

    public function actionGetCompanies() {
        $web = new WebUtil();

        
        $model = MCompany::model()->findAll();

        $web->sendResponse(200, CJSON::encode(array("data"=>$model, "success" => TRUE, "total"=>2)));
    }

}