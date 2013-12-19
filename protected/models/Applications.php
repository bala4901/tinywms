<?php

Yii::import('application.models._base.BaseApplications');

class Applications extends BaseApplications {

    public static function model($className = __CLASS__) {
        return parent::model($className);
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
                ->order('A.sort ASC');

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

    public function Create($params) {
        $model = new Applications();

        foreach ($params as $var => $value) {
            if ($this->hasAttribute($var)) {
                $this->$var = $value;
            }
        }
        
        if ($this->validate()) {
            if ($this->save(FALSE)) {
                return array("success" => TRUE, "id" => Yii::app()->db->getLastInsertID());
            }
        } else {
            return array("success" => FALSE, "message" => $this->getErrors());
        }
    }

    public function Write($params) {
        $model = Applications::model()->findByPk($params->application_k);

        if (isset($model)) {
            foreach ($form as $var => $value) {
                // Does model have this attribute?
                if ($model->hasAttribute($var)) {
                    $model->$var = $value;
                } else {
                    // No, raise error
                    $web->sendResponse(500, CJSON::encode(array("success" => FALSE, "message" => "Parameter <b>%s</b> is not allowed for applications.", $var)));
                }
            }
            // Try to save the model
            if ($model->save()) {
                $web->sendResponse(200, CJSON::encode(array("success" => TRUE, "application_k" => $model->application_k, "message" => "Application successfully updated")));
            } else {
                $web->sendResponse(200, CJSON::encode(array("success" => FALSE, "message" => "There was an error updating this application.")));
            }
        }
    }

}
