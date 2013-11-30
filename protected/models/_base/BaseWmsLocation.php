<?php

/**
 * This is the model base class for the table "wms_location".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "WmsLocation".
 *
 * Columns in table "wms_location" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property string $location_code
 * @property integer $area_id
 * @property integer $wh_id
 * @property integer $sort
 * @property integer $create_uid
 * @property string $create_date
 * @property integer $write_uid
 * @property string $write_date
 *
 */
abstract class BaseWmsLocation extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'wms_location';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'WmsLocation|WmsLocations', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, location_code, area_id, wh_id, sort, create_uid, create_date, write_uid, write_date', 'required'),
			array('area_id, wh_id, sort, create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('id, name, location_code, area_id, wh_id, sort, create_uid, create_date, write_uid, write_date', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
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
			'location_code' => Yii::t('app', 'Location Code'),
			'area_id' => Yii::t('app', 'Area'),
			'wh_id' => Yii::t('app', 'Wh'),
			'sort' => Yii::t('app', 'Sort'),
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
		$criteria->compare('location_code', $this->location_code, true);
		$criteria->compare('area_id', $this->area_id);
		$criteria->compare('wh_id', $this->wh_id);
		$criteria->compare('sort', $this->sort);
		$criteria->compare('create_uid', $this->create_uid);
		$criteria->compare('create_date', $this->create_date, true);
		$criteria->compare('write_uid', $this->write_uid);
		$criteria->compare('write_date', $this->write_date, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}