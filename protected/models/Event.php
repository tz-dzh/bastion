<?php

/**
 * This is the model class for table "{{event}}".
 *
 * The followings are the available columns in table '{{event}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $event_time
 * @property integer $create_time
 * @property integer $update_time
 * @property string $details
 * @property integer $author_id
 */
class Event extends CActiveRecord
{
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{event}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description', 'required'),
			array('title', 'length', 'max'=>128),
			array('event_time', 'numerical'),
			array('event_time', 'length', 'max'=>11),
			array('details', 'safe'),
			array('title, description', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
			'applications' => array(self::HAS_MANY, 'Application', 'event_id', 'order'=>'applications.create_time DESC'),
			'applicationCount' => array(self::STAT, 'Application', 'event_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'event_time' => 'Event Start Time',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'details' => 'Details',
			'author_id' => 'Author',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('author_id',$this->author_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'event_time DESC',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the URL that shows the detail of the event
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('event/view', array(
			'id'=>$this->id,
			'title'=>$this->title,
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
			{
				$this->create_time=$this->update_time=time();
				$this->author_id=Yii::app()->user->id;
			}
			else
				$this->update_time=time();
			// serializing data
			if(is_array($this->details))
				$this->details=serialize($this->details);
			return true;
		}
		else
			return false;
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();
		Application::model()->deleteAll('event_id='.$this->id);
	}

	/**
	 * Adds a new application to this event.
	 * This method will set status and event_id of the application accordingly.
	 * @param Comment the application to be added
	 * @return boolean whether the application is saved successfully
	 */
	public function addApplication($application)
	{
		$application->event_id=$this->id;
		$application->author_id=Yii::app()->user->id;
		return $application->save();
	}
}
