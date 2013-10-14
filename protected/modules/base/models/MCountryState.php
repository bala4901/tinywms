<?php

/**
 * This is the model class for table "m_country_state".
 *
 * The followings are the available columns in table 'm_country_state':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $country_id
 * @property integer $created_uid
 * @property string $created_date
 * @property integer $write_uid
 * @property string $write_date
 *
 * The followings are the available model relations:
 * @property MCountry $country
 * @property Users $createdU
 * @property Users $writeU
 * @property MPartner[] $mPartners
 */
class MCountryState extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_country_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name, code, country_id, created_uid, created_date, write_uid, write_date', 'required'),
			array('id, country_id, created_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('code', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, country_id, created_uid, created_date, write_uid, write_date', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'MCountry', 'country_id'),
			'createdU' => array(self::BELONGS_TO, 'Users', 'created_uid'),
			'writeU' => array(self::BELONGS_TO, 'Users', 'write_uid'),
			'mPartners' => array(self::HAS_MANY, 'MPartner', 'state_id'),
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
			'country_id' => 'Country',
			'created_uid' => 'Created Uid',
			'created_date' => 'Created Date',
			'write_uid' => 'Write Uid',
			'write_date' => 'Write Date',
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
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('created_uid',$this->created_uid);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('write_date',$this->write_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MCountryState the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
