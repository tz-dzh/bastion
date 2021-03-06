<?php

class ApplicationController extends Controller
{
	public $layout='column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated users to access all actions
				//'users'=>array('@'),
				'roles'=>array('admin'/*,'member'*/),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['ajax']) && $_POST['ajax']==='application-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['Application']))
		{
			$model->attributes=$_POST['Application'];
			if($model->save())
				$this->redirect(array('event/admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	/*todo: add ajax or post request with confirmation*/
	public function actionDelete()
	{
		/*if(Yii::app()->request->isPostRequest)
		{*/
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('event/admin'));
		/*}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');*/
	}

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Application', array(
			'criteria'=>array(
				'with'=>'event',
				'order'=>'t.create_time DESC',
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Application::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
