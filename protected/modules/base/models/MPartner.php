<?php

/**
 * This is the model class for table "m_partner".
 *
 * The followings are the available columns in table 'm_partner':
 * @property integer $id
 * @property string $name
 * @property integer $lang
 * @property integer $company_id
 * @property integer $created_uid
 * @property string $created_date
 * @property integer $write_uid
 * @property string $write_date
 * @property string $comment
 * @property string $barcode
 * @property string $image
 * @property string $use_parent_address
 * @property integer $active
 * @property string $street
 * @property string $city
 * @property integer $zip
 * @property string $title
 * @property integer $country_id
 * @property integer $parent_id
 * @property string $email
 * @property string $website
 * @property string $fax
 * @property string $street2
 * @property string $mobile
 * @property string $ref
 * @property string $birthdate
 * @property integer $is_company
 * @property integer $supplier
 * @property integer $customer
 * @property integer $state_id
 *
 * The followings are the available model relations:
 * @property MCompany[] $mCompanies
 * @property MCompany $company
 * @property MCountry $country
 * @property MCountryState $state
 * @property Users $createdU
 * @property Users $writeU
 */
class MPartner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_partner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_uid, write_uid', 'required'),
			array('lang, company_id, created_uid, write_uid, active, zip, country_id, parent_id, is_company, supplier, customer, state_id', 'numerical', 'integerOnly'=>true),
			array('name, barcode, use_parent_address, street, city, title, email, website, street2', 'length', 'max'=>45),
			array('comment', 'length', 'max'=>125),
			array('fax, mobile', 'length', 'max'=>20),
			array('ref', 'length', 'max'=>15),
			array('created_date, write_date, image, birthdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, lang, company_id, created_uid, created_date, write_uid, write_date, comment, barcode, image, use_parent_address, active, street, city, zip, title, country_id, parent_id, email, website, fax, street2, mobile, ref, birthdate, is_company, supplier, customer, state_id', 'safe', 'on'=>'search'),
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
			'mCompanies' => array(self::HAS_MANY, 'MCompany', 'partner_id'),
			'company' => array(self::BELONGS_TO, 'MCompany', 'company_id'),
			'country' => array(self::BELONGS_TO, 'MCountry', 'country_id'),
			'state' => array(self::BELONGS_TO, 'MCountryState', 'state_id'),
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
			'lang' => 'Lang',
			'company_id' => 'Company',
			'created_uid' => 'Created Uid',
			'created_date' => 'Created Date',
			'write_uid' => 'Write Uid',
			'write_date' => 'Write Date',
			'comment' => 'Comment',
			'barcode' => 'Barcode',
			'image' => 'Image',
			'use_parent_address' => 'Use Parent Address',
			'active' => 'Active',
			'street' => 'Street',
			'city' => 'City',
			'zip' => 'Zip',
			'title' => 'Title',
			'country_id' => 'Country',
			'parent_id' => 'Parent',
			'email' => 'Email',
			'website' => 'Website',
			'fax' => 'Fax',
			'street2' => 'Street2',
			'mobile' => 'Mobile',
			'ref' => 'Ref',
			'birthdate' => 'Birthdate',
			'is_company' => 'Is Company',
			'supplier' => 'Supplier',
			'customer' => 'Customer',
			'state_id' => 'State',
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
		$criteria->compare('lang',$this->lang);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('created_uid',$this->created_uid);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('use_parent_address',$this->use_parent_address,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('zip',$this->zip);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('street2',$this->street2,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('ref',$this->ref,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('is_company',$this->is_company);
		$criteria->compare('supplier',$this->supplier);
		$criteria->compare('customer',$this->customer);
		$criteria->compare('state_id',$this->state_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MPartner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
