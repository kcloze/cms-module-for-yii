<?php

/**
 * This is the model class for table "news_videos".
 *
 * The followings are the available columns in table 'news_videos':
 * @property string $Id
 * @property integer $VId
 * @property integer $CateId
 * @property string $Title
 * @property string $Description
 * @property string $VideoThumb
 * @property string $Video
 * @property string $CreateTime
 * @property string $UpdateTime
 * @property string $UserId
 */
class NewsVideos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NewsVideos the static model class
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
		return 'news_videos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' CateId, Title,VideoThumb,Video', 'required'),
			array('CateId', 'numerical', 'integerOnly'=>true),
			array('Title, Description, VideoThumb, Video', 'length', 'max'=>255),
			array('UserId', 'length', 'max'=>20),
			array('CreateTime, UpdateTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, VId, CateId, Title, Description, VideoThumb, Video, CreateTime, UpdateTime, UserId', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'VId' => '视频集id',
			'CateId' => '分类id',
			'Title' => '名称',
			'Description' => '描述',
			'VideoThumb' => '封面图',
			'Video' => '视频路径',
			'CreateTime' => '创建时间',
			'UpdateTime' => '更新时间',
			'UserId' => '用户Id',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('VId',$this->VId);
		$criteria->compare('CateId',$this->CateId);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('VideoThumb',$this->VideoThumb,true);
		$criteria->compare('Video',$this->Video,true);
		$criteria->compare('CreateTime',$this->CreateTime,true);
		$criteria->compare('UpdateTime',$this->UpdateTime,true);
		$criteria->compare('UserId',$this->UserId,true);
        $criteria->order = 'id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}