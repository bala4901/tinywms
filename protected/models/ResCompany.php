<?php

/**
 * This is the model class for table "res_company".
 *
 * The followings are the available columns in table 'res_company':
 * @property integer $id
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
 * The followings are the available model relations:
 * @property ResPartner $partner
 * @property ResCurrency $currency
 * @property ResCurrency[] $resCurrencies
 * @property ResPartner[] $resPartners
 */
class ResCompany extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'res_company';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, partner_id', 'required'),
            array('parent_id, partner_id, create_id, write_uid, currency_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('create_date, write_date, logo_web', 'safe'),
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
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, parent_id, partner_id, create_id, create_date, write_uid, write_date, logo_web, currency_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
            'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
            'resCurrencies' => array(self::HAS_MANY, 'ResCurrency', 'company_id'),
            'resPartners' => array(self::HAS_MANY, 'ResPartner', 'company_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent',
            'partner_id' => 'Partner',
            'create_id' => 'Create',
            'create_date' => 'Create Date',
            'write_uid' => 'Write Uid',
            'write_date' => 'Write Date',
            'logo_web' => 'Logo Web',
            'currency_id' => 'Currency',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
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

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ResCompany the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
