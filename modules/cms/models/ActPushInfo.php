<?php

/**
 * This is the model class for table "act_push_info".
 *
 * The followings are the available columns in table 'act_push_info':
 * @property string $id
 * @property string $title
 * @property string $remark
 * @property string $push_num
 * @property integer $status
 * @property string $c_time
 */
class ActPushInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ActPushInfo the static model class
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
		return 'act_push_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, remark, c_time', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('push_num', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, remark, push_num, status, c_time', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'title' => '标题',
			'remark' => '内容',
			'push_num' => '短信端口号',
			'status' => '状态',
			'c_time' => '创建时间',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('push_num',$this->push_num,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('c_time',$this->c_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function getStatus($stauts){
		if($stauts==1){
			return '停用';
		}else{
			return '启用';
		}
	}
}