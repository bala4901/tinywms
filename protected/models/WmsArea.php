<?php

Yii::import('application.models._base.BaseWmsArea');

class WmsArea extends BaseWmsArea {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getLists($params) {
        $condition = 't.active=1';

        $totalItems = $this->count($condition);

        $criteria = new CDbCriteria(array(
            'condition' => $condition,
            'order' => 't.id ASC',
            'limit' => $params["limit"],
            'offset' => $params["start"] // if offset less, thah 0 - it starts from the beginning
        ));
        $data = $this->with(
                        array('warehouse' =>
                            array(
                                'select' => 'name',
                                'joinType' => 'INNER JOIN'),
                            'areatype' =>
                            array(
                                'select' => 'name',
                                'joinType' => 'INNER JOIN')
                        )
                )->findAll($criteria);

        return array("data" => $data, "total" => $totalItems);
    }

    public function getComboSelect() {
        $criteria = new CDbCriteria;
        $criteria->select = 't.id, t.name'; // select fields which you want in output
        $criteria->condition = 't.active = 1';
        $criteria->order = 't.name asc';

        $data = $this->findAll($criteria);

        return $data;
    }

    public function Create($params) {
        foreach ($params as $var => $value) {
            if ($this->hasAttribute($var)) {
                $this->$var = $value;
            }
        }

        if ($this->validate()) {
            if ($this->save()) {
                return array("success" => TRUE, "id" => Yii::app()->db->getLastInsertID());
            }
        } else {
            return array("success" => FALSE, "message" => $this->getErrors());
        }
    }

    public function Write($params) {
        foreach ($params as $var => $value) {
            if ($var <> "id") {
                if ($this->hasAttribute($var)) {
                    $this->$var = $value;
                }
            }
        }

        if ($this->validate()) {
            if ($this->save()) {
                return array("success" => TRUE, "id" => $this->id);
            }
        } else {
            return array("success" => FALSE, "message" => $this->getErrors());
        }
    }

    public function Deactive() {

        $this->active = 0;

        if ($this->validate()) {
            if ($this->save()) {
                return array("success" => TRUE, "id" => $this->id);
            }
        } else {
            return array("success" => FALSE, "message" => $this->getErrors());
        }
    }

}
