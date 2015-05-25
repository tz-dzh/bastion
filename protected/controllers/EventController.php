<?php

class EventController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
			//'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'roles'=>array('admin','member'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$event=$this->loadModel();
		$application=$this->newApplication($event);

		$this->render('view',array(
			'model'=>$event,
			'application'=>$application,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(Yii::app()->user->checkAccess('createPost'))
		{
			$model=new Event;
			if(isset($_POST['Event']))
			{
				$model->attributes=$_POST['Event'];
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}

			$this->render('create',array(
				'model'=>$model,
			));
		}
		else
			throw new CHttpException(403,'Forbidden');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel();
		// checking if user can edit all posts
		if(Yii::app()->user->checkAccess('updatePost'))
		{
			if(isset($_POST['Event']))
			{
				$model->attributes=$_POST['Event'];
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}

			$this->render('update',array(
				'model'=>$model,
			));
		}
		else
			throw new CHttpException(403,'Forbidden');
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest && Yii::app()->user->checkAccess('deletePost'))
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria(array(
			//'condition'=>'status='.Event::STATUS_PUBLISHED,
			'order'=>'event_time DESC',
			//'with'=>'commentCount',
		));

		$dataProvider=new CActiveDataProvider('Event', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['postsPerPage'],
			),
			'criteria'=>$criteria,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Event('search');
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];
		// for members we show only their posts
		if(!Yii::app()->user->checkAccess('updatePost'))
			$model->setAttributes(array('author_id'=>Yii::app()->user->id),false);
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Event the loaded model
	 * @throws CHttpException
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				/*if(Yii::app()->user->isGuest)
					$condition='status='.Event::STATUS_PUBLISHED.' OR status='.Event::STATUS_ARCHIVED;
				else*/
					$condition='';
				$this->_model=Event::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			// details
			if(!empty($this->_model->details))
				$this->_model->details=unserialize($this->_model->details);
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Event $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Creates a new application.
	 * This method attempts to create a new application based on the user input.
	 * If the application is successfully created, the browser will be redirected
	 * to show the created application.
	 * @param Post the event that the new application belongs to
	 * @return Comment the application instance
	 */
	protected function newApplication($event)
	{
		$application=new Application;
		if(isset($_POST['ajax']) && $_POST['ajax']==='application-form')
		{
			echo CActiveForm::validate($application);
			Yii::app()->end();
		}
		if(isset($_POST['Application']))
		{
			$application->attributes=$_POST['Application'];
			if($event->addApplication($application))
			{
				Yii::app()->user->setFlash('applicationSubmitted','Thank you for your application.');
				$this->refresh();
			}
		}
		return $application;
	}
}
