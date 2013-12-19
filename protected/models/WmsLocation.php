<?php

Yii::import('application.models._base.BaseWmsLocation');

class WmsLocation extends BaseWmsLocation {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getLists($params) {
        //$condition = 't.active=1';
        $condition = '';

        $totalItems = $this->count($condition);

        $criteria = new CDbCriteria(array(
            'condition' => $condition,
            'order' => 't.sort ASC',
            'limit' => $params["limit"],
            'offset' => $params["start"] // if offset less, thah 0 - it starts from the beginning
        ));
        $data = $this->with(
                        array('area' =>
                            array(
                                'select' => 'name',
                                'joinType' => 'INNER JOIN'
                            ),
                            'warehouse' =>
                            array(
                                'select' => 'name',
                                'joinType' => 'INNER JOIN',
                            )
                        )
                )->findAll($criteria);

        return array("data" => $data, "total" => $totalItems);
    }

}
