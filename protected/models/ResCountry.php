<?php

/**
 * This is the model class for table "res_country".
 *
 * The followings are the available columns in table 'res_country':
 * @property integer $id
 * @property string $name
 * @property integer $create_uid
 * @property string $create_date
 * @property integer $write_uid
 * @property string $write_date
 * @property integer $currency_id
 * @property string $code
 * @property string $address_format
 *
 * The followings are the available model relations:
 * @property ResPartner[] $resPartners
 */
class ResCountry extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'res_country';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, currency_id, code, address_format', 'required'),
            array('create_uid, write_uid, currency_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('code', 'length', 'max' => 2),
            array('create_date, write_date', 'safe'),
            array('write_date', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('create_date,write_date', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, create_uid, create_date, write_uid, write_date, currency_id, code, address_format', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'resPartners' => array(self::HAS_MANY, 'ResPartner', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_uid' => 'Write Uid',
            'write_date' => 'Write Date',
            'currency_id' => 'Currency',
            'code' => 'Code',
            'address_format' => 'Address Format',
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
        $criteria->compare('create_uid', $this->create_uid);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('write_uid', $this->write_uid);
        $criteria->compare('write_date', $this->write_date, true);
        $criteria->compare('currency_id', $this->currency_id);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('address_format', $this->address_format, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ResCountry the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
