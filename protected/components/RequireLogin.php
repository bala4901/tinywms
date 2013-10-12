<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RequireLogin
 *
 * @author markus
 */
class RequireLogin extends CBehavior {

    //put your code here
    public function attach($owner) {
        $owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
    }

    public function handleBeginRequest($event) {
        if (Yii::app()->user->isGuest && !in_array(Yii::app()->request->pathInfo, array('site/login','users/login'))) {
            if (!preg_match("/^api.*/", Yii::app()->request->pathInfo))
            {
                Yii::app()->user->loginRequired();
            }
            
        }
    }
}

?>
