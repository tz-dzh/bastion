<?php

class UserController extends Controller
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
			array('allow', // allow admins only
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	/*public function actionView()
	{
		$post=$this->loadModel();
		$comment=$this->newComment($post);

		$this->render('view',array(
			'model'=>$post,
			'comment'=>$comment,
		));
	}*/

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		// ckecking if this is post of current member
		$params['user']=$model;
		// ...or user can edit all posts
		if(isset($_POST['User']))
		{
			$prev_role	=	$model->role;
			$model->attributes=$_POST['User'];
			// assigning a role
			$new_role 	=	$_POST['User']['role'];
			if($prev_role != $new_role)
				$model->role=$new_role;
			// saving
			if($model->save()){
				// changing role
				if($prev_role != $new_role){
					$auth=Yii::app()->authManager;
					$auth->revoke($prev_role, $model->id);
					$auth->assign($new_role, $model->id);
					$auth->save();
				}
				$this->redirect(array('admin'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		// we only allow deletion via POST request
		$this->loadModel()->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		// for members we show only their posts
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$this->_model=User::model()->findByPk($_GET['id']);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
