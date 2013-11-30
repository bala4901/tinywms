<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_k
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $name
 * @property string $lastname
 * @property string $avatar
 * @property integer $active
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $partner_id
 *
 * The followings are the available model relations:
 * @property UserPermissions[] $userPermissions
 * @property UserRoles[] $userRoles
 * @property ResPartner $partner
 */
class Users extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, email, name, lastname, active', 'required'),
            array('active, create_uid, write_uid, partner_id', 'numerical', 'integerOnly' => true),
            array('username', 'length', 'max' => 20),
            array('password', 'length', 'max' => 32),
            array('email', 'length', 'max' => 100),
            array('name, lastname', 'length', 'max' => 50),
            array('avatar', 'length', 'max' => 255),
            array('create_date, write_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_k, username, password, email, name, lastname, avatar, active, create_uid, create_date, write_date, write_uid, partner_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userPermissions' => array(self::HAS_MANY, 'UserPermissions', 'user_k'),
            'userRoles' => array(self::HAS_MANY, 'UserRoles', 'user_k'),
            'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_k' => 'User K',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'avatar' => 'Avatar',
            'active' => 'Active',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'partner_id' => 'Partner',
        );
    }

    public function getUsers($params) {
        $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM users')->queryScalar();
        $sql = 'select user_k, username,  email, name, lastname, avatar, active from users ';
        $dataProvider = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'name', 'username',
                ),
            ),
            'pagination' => array(
                'pageSize' => $params["limit"],
            ),
        ));

        return $dataProvider->getData();
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

        $criteria->compare('user_k', $this->user_k);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('avatar', $this->avatar, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('create_uid', $this->create_uid);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('write_date', $this->write_date, true);
        $criteria->compare('write_uid', $this->write_uid);
        $criteria->compare('partner_id', $this->partner_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
