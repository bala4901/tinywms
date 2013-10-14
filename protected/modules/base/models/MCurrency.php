<?php

/**
 * This is the model class for table "m_currency".
 *
 * The followings are the available columns in table 'm_currency':
 * @property integer $id
 * @property string $name
 * @property string $symbol
 * @property integer $base
 * @property integer $active
 * @property string $rounding
 * @property integer $company_id
 * @property integer $accuracy
 * @property integer $created_uid
 * @property string $created_date
 * @property integer $write_uid
 * @property string $write_date
 * @property string $position
 *
 * The followings are the available model relations:
 * @property MCountry[] $mCountries
 * @property MCompany $company
 * @property Users $createdU
 * @property Users $writeU
 */
class MCurrency extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_currency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_uid, created_date, write_uid, write_date', 'required'),
			array('base, active, company_id, accuracy, created_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('symbol', 'length', 'max'=>4),
			array('rounding', 'length', 'max'=>7),
			array('position', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, symbol, base, active, rounding, company_id, accuracy, created_uid, created_date, write_uid, write_date, position', 'safe', 'on'=>'search'),
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
			'mCountries' => array(self::HAS_MANY, 'MCountry', 'currency_uid'),
			'company' => array(self::BELONGS_TO, 'MCompany', 'company_id'),
			'createdU' => array(self::BELONGS_TO, 'Users', 'created_uid'),
			'writeU' => array(self::BELONGS_TO, 'Users', 'write_uid'),
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
			'symbol' => 'Symbol',
			'base' => 'Base',
			'active' => 'Active',
			'rounding' => 'Rounding',
			'company_id' => 'Company',
			'accuracy' => 'Accuracy',
			'created_uid' => 'Created Uid',
			'created_date' => 'Created Date',
			'write_uid' => 'Write Uid',
			'write_date' => 'Write Date',
			'position' => 'Position',
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
		$criteria->compare('symbol',$this->symbol,true);
		$criteria->compare('base',$this->base);
		$criteria->compare('active',$this->active);
		$criteria->compare('rounding',$this->rounding,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('accuracy',$this->accuracy);
		$criteria->compare('created_uid',$this->created_uid);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('position',$this->position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MCurrency the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
