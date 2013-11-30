<?php

/**
 * This is the model base class for the table "wms_warehouse".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "WmsWarehouse".
 *
 * Columns in table "wms_warehouse" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property string $wh_code
 * @property integer $company_id
 * @property integer $create_uid
 * @property string $create_date
 * @property integer $write_uid
 * @property string $write_date
 *
 */
abstract class BaseWmsWarehouse extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'wms_warehouse';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'WmsWarehouse|WmsWarehouses', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, company_id, create_uid, create_date, write_uid, write_date', 'required'),
			array('company_id, create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('wh_code', 'safe'),
			array('wh_code', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, wh_code, company_id, create_uid, create_date, write_uid, write_date', 'safe', 'on'=>'search'),
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
			'wh_code' => Yii::t('app', 'Wh Code'),
			'company_id' => Yii::t('app', 'Company'),
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
		$criteria->compare('wh_code', $this->wh_code, true);
		$criteria->compare('company_id', $this->company_id);
		$criteria->compare('create_uid', $this->create_uid);
		$criteria->compare('create_date', $this->create_date, true);
		$criteria->compare('write_uid', $this->write_uid);
		$criteria->compare('write_date', $this->write_date, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}