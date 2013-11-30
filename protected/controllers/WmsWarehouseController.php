<?php

class WmsWarehouseController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'WmsWarehouse'),
		));
	}

	public function actionCreate() {
		$model = new WmsWarehouse;


		if (isset($_POST['WmsWarehouse'])) {
			$model->setAttributes($_POST['WmsWarehouse']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'WmsWarehouse');


		if (isset($_POST['WmsWarehouse'])) {
			$model->setAttributes($_POST['WmsWarehouse']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'WmsWarehouse')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('WmsWarehouse');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new WmsWarehouse('search');
		$model->unsetAttributes();

		if (isset($_GET['WmsWarehouse']))
			$model->setAttributes($_GET['WmsWarehouse']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}