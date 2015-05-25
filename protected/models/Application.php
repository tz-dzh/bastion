<?php

class Application extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_application':
	 * @var integer $id
	 * @var string $content
	 * @var integer $create_time
	 * @var integer $author_id
	 * @var integer $rate
	 * @var boolean $accepted
	 * @var integer $event_id
	 */

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
		return '{{application}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('rate', 'numerical'),
			array('rate', 'length', 'max'=>1),
			array('accepted', 'boolean'),
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
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'content' => 'Application',
			'create_time' => 'Create Time',
			'author_id' => 'Author',
			'rate' => 'Rate',
			'accepted' => 'Accepted',
			'event_id' => 'Event',
		);
	}

	/**
	 * @param Post the event that this application belongs to. If null, the method
	 * will query for the event.
	 * @return string the permalink URL for this application
	 */
	public function getUrl($event=null)
	{
		if($event===null)
			$event=$this->event;
		return $event->url.'#c'.$this->id;
	}

	/**
	 * @return string the hyperlink display for the current application's author
	 */
	public function getAuthorLink()
	{
		if(!empty($this->url))
			return CHtml::link(CHtml::encode($this->author->username),$this->url);
		else
			return CHtml::encode($this->author);
	}

	/**
	 * @param integer the maximum number of applications that should be returned
	 * @return array the most recently added applications
	 */
	public function findRecentApplication($limit=10)
	{
		return $this->with('event')->findAll(array(
			'order'=>'t.create_time DESC',
			'limit'=>$limit,
		));
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
				$this->create_time=time();
			return true;
		}
		else
			return false;
	}
}