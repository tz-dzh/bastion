<?php

class User extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $profile
	 * @var integer $role
	 */

	const ROLE_USER='user';
	const ROLE_MEMBER='member';
	const ROLE_ADMIN='admin';

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('username, password, email', 'length', 'max'=>128),
			array('profile', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',
			'password' => 'Confirmation Password',
			'email' => 'Email',
			'profile' => 'Profile',
			'role' => 'Role',
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

	public function beforeSave() {
		if(parent::beforeSave())
		{
			/*
			 * Если пользователь не имеет права изменять роль, то мы должны
			 * установить роль по-умолчанию (user)
			 */
			if (!Yii::app()->user->checkAccess('changeRole')) {
				if ($this->isNewRecord) {
					//ставим роль по-умолчанию user
					$this->role = self::ROLE_USER;
				}
			}
			return true;
		}
		else
			return false;
	}

	public function afterSave() {
		parent::afterSave();
		//связываем нового пользователя с ролью
		$auth=Yii::app()->authManager;
		//предварительно удаляем старую связь
		if(isset($this->prevRole) && $this->prevRole != $this->role)
			$auth->revoke($this->prevRole, $this->id);
		$new_role=isset($_POST['User']['role']) ? $_POST['User']['role'] : $this->role;
		if($this->role != $new_role)
			$auth->assign($new_role, $this->id);
		$auth->save();
		return true;
	}

	public function beforeDelete() {
		if(parent::beforeDelete())
		{
			//убираем связь удаленного пользователя с ролью
			$auth=Yii::app()->authManager;
			$auth->revoke($this->role, $this->id);
			$auth->save();
			return true;
		}
		else
			return false;
	}

	/**
	 * Returning user name by its id
	 * @todo:
	 */
	public function getUserById($id){
		if(isset($id))
		{
			$model=new User();
			$user=$model->findByAttributes(array('id'=>(int)$id));
			if($user)
				return $user->username;
			else
				return '';
		}
		else
			return '';
	}

	/**
	 * Retrieves the list of users based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the needed posts.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('role',$this->role);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'username, email ASC',
			),
		));
	}
}
