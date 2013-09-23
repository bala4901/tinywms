<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commons
 *
 * @author markus
 */
 class commons {
    //put your code here
    public static function dTrace($variable) {
        Yii::trace(CVarDumper::dumpAsString($variable), 'vardump');
    }
}

?>
