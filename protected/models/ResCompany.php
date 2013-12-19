<?php

Yii::import('application.models._base.BaseResCompany');

class ResCompany extends BaseResCompany {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getComboSelect() {
        $criteria = new CDbCriteria;
        $criteria->select = 't.id, t.name'; // select fields which you want in output
        $criteria->condition = 't.active = 1';
        $criteria->order = 't.name asc';

        $data = $this->findAll($criteria);
        
       return $data;
    }

}
