<?php

/**
 * This is the model class for table "m_company".
 *
 * The followings are the available columns in table 'm_company':
 * @property integer $id
 * @property string $name
 * @property string $company_code
 * @property string $created_date
 * @property integer $created_uid
 * @property string $write_date
 * @property integer $write_uid
 * @property string $logo_img
 * @property integer $partner_id
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property Users $createdU
 * @property Users $writeU
 * @property MPartner $partner
 * @property MCurrency[] $mCurrencies
 * @property MPartner[] $mPartners
 */
class MCompany extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_date, created_uid, write_date, write_uid', 'required'),
			array('created_uid, write_uid, partner_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('company_code', 'length', 'max'=>10),
			array('logo_img', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, company_code, created_date, created_uid, write_date, write_uid, logo_img, partner_id, parent_id', 'safe', 'on'=>'search'),
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
			'createdU' => array(self::BELONGS_TO, 'Users', 'created_uid'),
			'writeU' => array(self::BELONGS_TO, 'Users', 'write_uid'),
			'partner' => array(self::BELONGS_TO, 'MPartner', 'partner_id'),
			'mCurrencies' => array(self::HAS_MANY, 'MCurrency', 'company_id'),
			'mPartners' => array(self::HAS_MANY, 'MPartner', 'company_id'),
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
			'company_code' => 'Company Code',
			'created_date' => 'Created Date',
			'created_uid' => 'Created Uid',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'logo_img' => 'Logo Img',
			'partner_id' => 'Partner',
			'parent_id' => 'Parent',
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
		$criteria->compare('company_code',$this->company_code,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_uid',$this->created_uid);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('logo_img',$this->logo_img,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MCompany the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
