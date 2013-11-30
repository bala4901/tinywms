<?php

class WmsAreaController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'WmsArea'),
		));
	}

	public function actionCreate() {
		$model = new WmsArea;


		if (isset($_POST['WmsArea'])) {
			$model->setAttributes($_POST['WmsArea']);

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
		$model = $this->loadModel($id, 'WmsArea');


		if (isset($_POST['WmsArea'])) {
			$model->setAttributes($_POST['WmsArea']);

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
			$this->loadModel($id, 'WmsArea')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('WmsArea');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new WmsArea('search');
		$model->unsetAttributes();

		if (isset($_GET['WmsArea']))
			$model->setAttributes($_GET['WmsArea']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}