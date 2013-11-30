<?php

Yii::import('application.models._base.BaseWmsLocation');

class WmsLocation extends BaseWmsLocation
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}