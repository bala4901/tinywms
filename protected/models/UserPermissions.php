<?php

/**
 * This is the model class for table "user_permissions".
 *
 * The followings are the available columns in table 'user_permissions':
 * @property integer $user_permission_k
 * @property integer $user_k
 * @property integer $permission_k
 * @property integer $value
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property Users $userK
 * @property Permissions $permissionK
 */
class UserPermissions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_permissions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_k, permission_k, value, date_created', 'required'),
			array('user_k, permission_k, value', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_permission_k, user_k, permission_k, value, date_created', 'safe', 'on'=>'search'),
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
			'userK' => array(self::BELONGS_TO, 'Users', 'user_k'),
			'permissionK' => array(self::BELONGS_TO, 'Permissions', 'permission_k'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_permission_k' => 'User Permission K',
			'user_k' => 'User K',
			'permission_k' => 'Permission K',
			'value' => 'Value',
			'date_created' => 'Date Created',
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

		$criteria->compare('user_permission_k',$this->user_permission_k);
		$criteria->compare('user_k',$this->user_k);
		$criteria->compare('permission_k',$this->permission_k);
		$criteria->compare('value',$this->value);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPermissions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
