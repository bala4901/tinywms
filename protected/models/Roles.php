<?php

Yii::import('application.models._base.BaseRoles');

class Roles extends BaseRoles {

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
                ->limit($params["limit"], $params["offset"]);


        return $cmd->queryAll();
    }

    public function create($params) {
        foreach ($params as $var => $value) {
            if ($this->hasAttribute($var)) {
                $this->$var = $value;
            }
        }


        if ($this->validate()) {
            if ($this->save()) {

                $auth = Yii::app()->authManager;
                //$auth->createRole($this->name);
                $auth->removeAuthItem($this->name);
                
                        

                return array("success" => TRUE, "id" => Yii::app()->db->getLastInsertID());
            }
        } else {
            return array("success" => FALSE, "message" => $this->getErrors());
        }
    }

    public function write($params) {
        foreach ($params as $var => $value) {
            if ($var <> "role_k") {
                if ($this->hasAttribute($var)) {
                    $this->$var = $value;
                }
            }
        }

        if ($this->validate()) {
            if ($this->save()) {
                return array("success" => TRUE, "id" => Yii::app()->db->getLastInsertID());
            }
        } else {
            return array("success" => FALSE, "message" => $this->getErrors());
        }
    }

    public function rules() {

        $doremi = array(
            array('name', 'unique', 'on' => 'insert,update'),
        );

        return array_merge(parent::rules(), $doremi);
    }

}
