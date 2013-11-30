  <?php

/**
 * This is the model class for table "applications".
 *
 * The followings are the available columns in table 'applications':
 * @property integer $application_k
 * @property integer $application_parent_k
 * @property string $name
 * @property string $description
 * @property string $klass
 * @property string $configurations
 * @property string $date_created
 * @property string $date_updated
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Permissions[] $permissions
 */
class Applications extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'applications';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, description, klass, configurations, active', 'required'),
            array('application_parent_k, active', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 200),
            array('klass', 'length', 'max' => 255),
            array('date_updated', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'update'),
            array('date_updated,date_created', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('application_k, application_parent_k, name, description, klass, configurations, date_created, date_updated, active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'permissions' => array(self::HAS_MANY, 'Permissions', 'application_k'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'application_k' => 'Application K',
            'application_parent_k' => 'Application Parent K',
            'name' => 'Name',
            'description' => 'Description',
            'klass' => 'Klass',
            'configurations' => 'Configurations',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'active' => 'Active',
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

        $criteria->compare('application_k', $this->application_k);
        $criteria->compare('application_parent_k', $this->application_parent_k);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('klass', $this->klass, true);
        $criteria->compare('configurations', $this->configurations, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getApplications($params) {
        $cmd = Yii::app()->db->createCommand();
        $cmd->select('a.*')
                ->from('applications a')
                ->join('permissions p', 'p.application_k = a.application_k')
                ->join("role_permissions rp", "rp.permission_k=p.permission_k")
                ->join("roles r", "r.role_k=rp.role_k")
                ->join("user_roles ur", "ur.role_k=r.role_k")
                ->join("users u", "u.user_k=ur.user_k")
                ->where(
                        array(
                            'and',
                            "U.username='" . $params . "'",
                            "P.action='access'",
                            'RP.value=true'
                        )
                )
                ->group("A.application_k")
                ->order('A.application_parent_k ASC');

        $rows = $cmd->queryAll();

        return $this->renderRows($rows);
    }

    public function getApplicationPermission($params) {
        $cmd = Yii::app()->db->createCommand();
        $cmd->select('p.name, p.permission_k')
                ->from('applications a')
                ->join('permissions p', 'p.application_k = a.application_k')
                ->where("p.application_k='" . $params . "'")
                ->order('p.name asc');

        return $cmd->queryAll();
    }

    private function renderRows($rows) {
        $Models = array();

        foreach ($rows as $row) {
            $Model = new Applications();
            $Model->name = $row['name'];
            $Model->application_k = $row['application_k'];
            $Model->application_parent_k = $row['application_parent_k'];
            $Model->klass = $row['klass'];
            $Model->description = $row['description'];
            $Model->configurations = $row['configurations'];
            $Model->active = $row['active'];
            $Model->date_created = $row['date_created'];
            $Model->date_updated = $row['date_updated'];

            $Models[] = $Model;
        }
        return $Models;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Applications the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
