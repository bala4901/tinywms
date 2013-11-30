<?php

Yii::import('application.models._base.BaseWmsWarehouse');

class WmsWarehouse extends BaseWmsWarehouse
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}