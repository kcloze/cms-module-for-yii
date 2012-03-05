<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property string $Id
 * @property string $Title
 * @property string $Alias
 * @property string $Description
 * @property string $Image
 * @property string $ParentId
 * @property integer $IsActive
 * @property integer $Ordering
 */
class Categories extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Categories the static model class
	 */
	public $pname;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Title', 'required'),
			array('IsActive, Ordering', 'numerical', 'integerOnly'=>true),
			array('Title, Alias, Image', 'length', 'max'=>255),
			array('ParentId', 'length', 'max'=>20),
			array('Description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Title, Alias, Description, Image, ParentId, IsActive, Ordering', 'safe', 'on'=>'search'),
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
			'Title' => '名称',
			'Alias' => '别名',
			'Description' => '描述',
			'Image' => '图片',
			'ParentId' => '父类Id',
			'IsActive' => '是否有效',
			'Ordering' => '排序',
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
		//$criteria->addCondition('id ='.$this->Id,'OR');
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Alias',$this->Alias,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Image',$this->Image,true);
		/*if(is_array($this->ParentIds ) && $this->ParentIds[0]!=0){
		$criteria->addInCondition('ParentId',$this->ParentIds);
		}else{
			$criteria->compare('ParentId',$this->ParentId,true);
		}*/
		$criteria->compare('ParentId',$this->ParentId,false);
		$criteria->compare('IsActive',$this->IsActive);
		$criteria->compare('Ordering',$this->Ordering);
        $criteria->order = 'id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getPname($pid){
		if(empty($pid)) return '';
		$category=self::getCategories();
		return $category[$pid];
	}
	public  static function getCategories(){
	$command = Yii::app()->db->createCommand('SELECT id,title,parentId FROM categories' );
		$categories = $command->queryAll();
		$cate=array();
		if(is_array($categories)){
		    foreach($categories as $val){
				$cate[$val['id']]=$val['title']; 
			}
		}
		return $cate;
	}
}