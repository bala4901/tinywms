<?php

/**
 * This is the model base class for the table "wms_area".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "WmsArea".
 *
 * Columns in table "wms_area" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property string $area_code
 * @property integer $wh_id
 * @property integer $area_type_id
 * @property integer $active
 * @property integer $create_uid
 * @property string $create_date
 * @property integer $write_uid
 * @property string $write_date
 *
 */
abstract class BaseWmsArea extends GxActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'wms_area';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'WmsArea|WmsAreas', $n);
    }

    public static function representingColumn() {
        return 'name';
    }

    public function rules() {
        return array(
            array('name, area_type_id, active, create_uid, create_date, write_uid, write_date', 'required'),
            array('wh_id, area_type_id, active, create_uid, write_uid', 'numerical', 'integerOnly' => true),
            array('area_code', 'safe'),
            array('area_code, wh_id', 'default', 'setOnEmpty' => true, 'value' => null),
            array('write_uid', 'default',
                'value' => Yii::app()->user->getId(),
                'setOnEmpty' => false, 'on' => 'update'),
            array('create_uid,write_uid', 'default',
                'value' => Yii::app()->user->getId(),
                'setOnEmpty' => false, 'on' => 'insert'),
            array('write_date', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('create_date,write_date', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            array('id, name, area_code, wh_id, area_type_id, active, create_uid, create_date, write_uid, write_date', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'warehouse' => array(self::BELONGS_TO, 'WmsWarehouse', 'wh_id'),
            'areatype' => array(self::BELONGS_TO, 'WmsAreaType', 'area_type_id'),
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'area_code' => Yii::t('app', 'Area Code'),
            'wh_id' => Yii::t('app', 'Wh'),
            'area_type_id' => Yii::t('app', 'Area Type'),
            'active' => Yii::t('app', 'Active'),
            'create_uid' => Yii::t('app', 'Create Uid'),
            'create_date' => Yii::t('app', 'Create Date'),
            'write_uid' => Yii::t('app', 'Write Uid'),
            'write_date' => Yii::t('app', 'Write Date'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('area_code', $this->area_code, true);
        $criteria->compare('wh_id', $this->wh_id);
        $criteria->compare('area_type_id', $this->area_type_id);
        $criteria->compare('active', $this->active);
        $criteria->compare('create_uid', $this->create_uid);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('write_uid', $this->write_uid);
        $criteria->compare('write_date', $this->write_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
