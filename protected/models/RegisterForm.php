<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 * user register form data. It is used by the 'register' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $username;
	public $email;
	public $password;
	public $password2;
	public $role;

	private $_identity;

	const ROLE_ADMIN=1;
	const ROLE_USER=2;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('username, email, password, password2', 'required'),
			array('email','email'),
			array('username', 'length', 'min'=>2, 'max'=>12),
			array('username, email','unique','className'=>'User'),
			array('password2', 'compare', 'compareAttribute'=>'password'),
			array('role', 'in', 'range'=>array(1,2,3)),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate(/*$attribute,$params*/)
	{
		/*$this->_identity=new UserIdentity($this->username,$this->password);
		if(!$this->_identity->authenticate())
			$this->addError('password','Incorrect username or password.');*/
	}

	/**
	 * This class will handle all registration functionality
	 * @return boolean whether user was registered and email was sent
	 */
	public function register()
	{
		$model=new User;
		if(isset($_POST['RegisterForm']))
		{
			$post=$_POST['RegisterForm'];
			// hashing password
			$post['password']=User::model()->hashPassword($post['password']);
			unset($post['password2']);
			$model->attributes=$post;
			/*// setting role of default user
			$model->role=3;*/
			// creating user
			$result=$model->save();
			if($result)
			{
				// sending welcome email
				$subject='Добро пожаловать на официальный сайт клуба Бастион!';
				$message="Клуб исторической реконструкции и средневекового боя Бастион ДЗХ приветствует тебя, ".$post['username'];
				$message.="\nБудь как дома, путник.";
				mail($post['email'],$subject,$message);
				// logging in
				$this->_identity=new UserIdentity($post['username'],$_POST['RegisterForm']['password']);
				$this->_identity->authenticate();
				Yii::app()->user->login($this->_identity,60*60*24*30);//generates error if time=0
			}
			return $result;
		}
		else
		{
			return false;
		}
	}
}
