<?php

class SiteController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		// redirect a user to home page if he is already logged in
		if(!Yii::app()->user->isGuest)
			$this->redirect(array('post/index'));
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Register a new user
	 * @todo: add roles system (user/admin)
	 */
	public function actionRegister()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new RegisterForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->register())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('register',array('model'=>$model));
	}

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
			array('allow',  // allow all users to access 'error' and 'contact' actions.
				'actions'=>array('error','contact'),
				'users'=>array('*'),
			),
			array('deny', // deny authenticated users to access 'register' action
				'actions'=>array('register'),
				'users'=>array('@'),
			),
		);
	}

	/**
	 * This method we need to run only once to create roles and to set admin to existing user
	 * Admin:
	 *	createPost
	 *	updatePost
	 *	deletePost
	 *	changeRole
	 *	updateOwnPost
	 * Member:
	 *	createPost
	 *	updateOwnPost
	 */
	/*public function actionInstall() {
 
		$auth=Yii::app()->authManager;

		//сбрасываем все существующие правила
		$auth->clearAll();

		//Операции управления пользователями.
		$auth->createOperation('createPost', 'создание поста');
		$auth->createOperation('updatePost', 'изменение поста');
		$auth->createOperation('deletePost', 'удаление поста');
		$auth->createOperation('changeRole', 'изменение роли пользователя');

		$bizRule='return Yii::app()->user->id==$params["post"]->author_id;';
		$task = $auth->createTask('updateOwnPost', 'изменение своих постов', $bizRule);
		$task->addChild('updatePost');

		//создаем роль для пользователя member и указываем, какие операции он может выполнять
		$role = $auth->createRole('member');
		$role->addChild('createPost');
		$role->addChild('updateOwnPost');

		//все пользователи будут создаваться по-умолчанию с ролью user,
		//только root может менять роль другого пользователя

		//создаем роль для пользователя admin
		$role = $auth->createRole('admin');
		//наследуем операции, определённые для member'а и добавляем новые
		$role->addChild('member');
		$role->addChild('updatePost');
		$role->addChild('deletePost');
		$role->addChild('changeRole');

		//создаем роль user и добавляем операции для неё
		$user = $auth->createRole('user');

		//связываем пользователя с ролью
		$auth->assign('admin', 2);
		$auth->assign('member', 14);
		$auth->assign('user', 1);

		//сохраняем роли и операции
		$auth->save();

		echo 'Done!';
	}*/
}
