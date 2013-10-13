<?php

/**
 * This is the model class for table "roles".
 *
 * The followings are the available columns in table 'roles':
 * @property integer $role_k
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property RolePermissions[] $rolePermissions
 */
class Roles extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'roles';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, description', 'required'),
            array('name', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('role_k, name, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'rolePermissions' => array(self::HAS_MANY, 'RolePermissions', 'role_k'),
            'roleUsers' => array(self::HAS_MANY, 'UserRoles', 'role_k'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'role_k' => 'Role K',
            'name' => 'Name',
            'description' => 'Description',
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

        $criteria->compare('role_k', $this->role_k);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Roles the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getRolesUsers($params = array(0, 25)) {
        $cmd = Yii::app()->db->createCommand(
                "select R.*,U.users
            from roles R
            left join (
            select R.role_k,count(R.role_k) as users 
            from roles R
            join user_roles UR on UR.role_k=R.role_k
            group by R.role_k
            ) U on U.role_k=R.role_k");

        return $cmd->queryAll();
    }

    //Get all roles that contain the given permission
    public function getByPermissions($permission_k) {

        $cmd = Yii::app()->db->createCommand();
        $cmd->select("RP.*,R.name")
                ->from("role_permissions RP")
                ->join("roles R", "R.role_k=RP.role_k")
                ->where("RP.permission_k='" . $permission_k . "'");

        return $cmd->queryAll();
    }

    public function getUsers($role_k, $params) {
        $cmd = Yii::app()->db->createCommand();
        $cmd->select("U.*")
                ->from("users U")
                ->join("user_roles UR", "UR.user_k=U.user_k")
                ->where("UR.role_k=" . $role_k)
                ->limit($params["limit"],$params["offset"]);
                

        return $cmd->queryAll();
    }

}
