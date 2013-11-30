<?php

Yii::import('application.models._base.BaseResPartner');

class ResPartner extends BaseResPartner {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addCompanyPartner($obj) {
        $model = new ResPartner();

        foreach ($obj as $var => $value) {
            if ($model->hasAttribute($var)) {
                $model->$var = $value;
            }
        }
        $model->lang = 'en_Us';
        $model->save();
        $lala = $model->primaryKey;
        commons::dTrace($model->getErrors());
        return Yii::app()->db->getLastInsertID();
    }

}
