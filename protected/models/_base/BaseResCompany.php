<?php

/**
 * This is the model base class for the table "res_company".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ResCompany".
 *
 * Columns in table "res_company" available as properties of the model,
 * followed by relations of table "res_company" available as properties of the model.
 *
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property integer $parent_id
 * @property integer $partner_id
 * @property integer $create_id
 * @property string $create_date
 * @property integer $write_uid
 * @property string $write_date
 * @property string $logo_web
 * @property integer $currency_id
 *
 * @property ResPartner $partner
 * @property ResCurrency $currency
 * @property ResCurrency[] $resCurrencies
 * @property ResPartner[] $resPartners
 */
abstract class BaseResCompany extends GxActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'res_company';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'ResCompany|ResCompanies', $n);
    }

    public static function representingColumn() {
        return 'name';
    }

    public function rules() {
        return array(
            array('name, partner_id', 'required'),
            array('active, parent_id, partner_id, create_id, write_uid, currency_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('create_date, write_date, logo_web', 'safe'),
            array('active, parent_id, create_id, create_date, write_uid, write_date, logo_web, currency_id', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, active, name, parent_id, partner_id, create_id, create_date, write_uid, write_date, logo_web, currency_id', 'safe', 'on' => 'search'),
            array('write_uid', 'default',
                'value' => Yii::app()->user->getId(),
                'setOnEmpty' => false, 'on' => 'update'),
            array('create_id,write_uid', 'default',
                'value' => Yii::app()->user->getId(),
                'setOnEmpty' => false, 'on' => 'insert'),
            array('write_date', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('create_date,write_date', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
        );
    }

    public function relations() {
        return array(
            'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
            'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
            'resCurrencies' => array(self::HAS_MANY, 'ResCurrency', 'company_id'),
            'resPartners' => array(self::HAS_MANY, 'ResPartner', 'company_id'),
            'warehouses' => array(self::HAS_MANY, 'WmsWarehouse', 'company_id'),
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'active' => Yii::t('app', 'Active'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent'),
            'partner_id' => null,
            'create_id' => Yii::t('app', 'Create'),
            'create_date' => Yii::t('app', 'Create Date'),
            'write_uid' => Yii::t('app', 'Write Uid'),
            'write_date' => Yii::t('app', 'Write Date'),
            'logo_web' => Yii::t('app', 'Logo Web'),
            'currency_id' => null,
            'partner' => null,
            'currency' => null,
            'resCurrencies' => null,
            'resPartners' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('active', $this->active);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('partner_id', $this->partner_id);
        $criteria->compare('create_id', $this->create_id);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('write_uid', $this->write_uid);
        $criteria->compare('write_date', $this->write_date, true);
        $criteria->compare('logo_web', $this->logo_web, true);
        $criteria->compare('currency_id', $this->currency_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
