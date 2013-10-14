<?php

/**
 * This is the model class for table "m_country".
 *
 * The followings are the available columns in table 'm_country':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $currency_uid
 * @property string $created_date
 * @property integer $write_uid
 * @property string $write_date
 * @property integer $created_uid
 *
 * The followings are the available model relations:
 * @property MCurrency $currencyU
 * @property Users $writeU
 * @property Users $createdU
 * @property MCountryState[] $mCountryStates
 * @property MPartner[] $mPartners
 */
class MCountry extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code, currency_uid, write_uid, created_uid', 'required'),
			array('currency_uid, write_uid, created_uid', 'numerical', 'integerOnly'=>true),
			array('name, code', 'length', 'max'=>45),
			array('created_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, currency_uid, created_date, write_uid, write_date, created_uid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'currencyU' => array(self::BELONGS_TO, 'MCurrency', 'currency_uid'),
			'writeU' => array(self::BELONGS_TO, 'Users', 'write_uid'),
			'createdU' => array(self::BELONGS_TO, 'Users', 'created_uid'),
			'mCountryStates' => array(self::HAS_MANY, 'MCountryState', 'country_id'),
			'mPartners' => array(self::HAS_MANY, 'MPartner', 'country_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'code' => 'Code',
			'currency_uid' => 'Currency Uid',
			'created_date' => 'Created Date',
			'write_uid' => 'Write Uid',
			'write_date' => 'Write Date',
			'created_uid' => 'Created Uid',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('currency_uid',$this->currency_uid);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('created_uid',$this->created_uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MCountry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
