<?php

/**
 * This is the model class for table "permissions".
 *
 * The followings are the available columns in table 'permissions':
 * @property integer $permission_k
 * @property integer $application_k
 * @property string $action
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Applications $applicationK
 * @property RolePermissions[] $rolePermissions
 * @property UserPermissions[] $userPermissions
 */
class Permissions extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'permissions';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('application_k, action, name', 'required'),
            array('application_k', 'numerical', 'integerOnly' => true),
            array('action', 'length', 'max' => 50),
            array('name', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('permission_k, application_k, action, name, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'applicationK' => array(self::BELONGS_TO, 'Applications', 'application_k'),
            'rolePermissions' => array(self::HAS_MANY, 'RolePermissions', 'permission_k'),
            'userPermissions' => array(self::HAS_MANY, 'UserPermissions', 'permission_k'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'permission_k' => 'Permission K',
            'application_k' => 'Application K',
            'action' => 'Action',
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

        $criteria->compare('permission_k', $this->permission_k);
        $criteria->compare('application_k', $this->application_k);
        $criteria->compare('action', $this->action, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    //get application permissions for an user based in his role
    public function getUserRoleAppPermission($data) {
        $cmd = Yii::app()->db->createCommand();
        $cmd->select('upper(P.action) as action, RP.value')
                ->from("permissions P")
                ->join("role_permissions RP", "RP.permission_k = P.permission_k")
                ->join("roles R", "R.role_k = RP.role_k")
                ->join("user_roles UR", "UR.role_k = R.role_k")
                ->join("users U", "U.user_k = UR.user_k")
                ->where(array(
                    "P.application_k='" . $data["application_k"] . "'",
                    "U.user_k='" . $data["user_k"] . "'"
        ));

        $rows = $cmd->queryAll();

        return $rows;
    }

    public function addPermissions($id) {
        $permissions = array(
            array("application_k" => $id, "action" => "access", "name" => "Access", "description" => "To access the menu"),
            array("application_k" => $id, "action" => "view", "name" => "View", "description" => "View"),
            array("application_k" => $id, "action" => "list", "name" => "List", "description" => "List"),
            array("application_k" => $id, "action" => "edit", "name" => "Edit", "description" => "Edit"),
            array("application_k" => $id, "action" => "delete", "name" => "Delete", "description" => "Delete"),
            array("application_k" => $id, "action" => "export", "name" => "Export", "description" => "Export"),
            array("application_k" => $id, "action" => "print", "name" => "Print", "description" => "Print"),
        );

        foreach ($permissions as $p) {
            $model = new Permissions();
            foreach ($p as $var => $value) {
                if ($model->hasAttribute($var)) {
                    $model->$var = $value;
                }
                $model->save();
            }
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Permissions the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
