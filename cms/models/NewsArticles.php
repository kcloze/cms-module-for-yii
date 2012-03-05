<?php

/**
 * This is the model class for table "news_articles".
 *
 * The followings are the available columns in table 'news_articles':
 * @property string $Id
 * @property string $Title
 * @property string $Alias
 * @property string $Tags
 * @property string $Content
 * @property integer $Status
 * @property integer $Url
 * @property string $CreatedDate
 * @property string $UpdatedDate
 * @property string $UserId
 * @property integer $Views
 * @property integer $Useful
 * @property integer $Unuseful
 * @property integer $CateId
 * @property string $SmallImage
 * @property string $BigImage
 */
class NewsArticles extends CActiveRecord
{
	
	public $uploaded_BigImage;
	public $uploaded_SmallImage;
	public $CTitle;//父类名称
	/**
	 * Returns the static model of the specified AR class.
	 * @return NewsArticles the static model class
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
		return 'news_articles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Title,CateId', 'required'),
			array('Status,  Views, Useful, Unuseful,City,Uid,CateId,ActType,NewHot,IsWebImage,IsWebList,IsWapImage,IsWapList,IsWapIndex', 'numerical', 'integerOnly'=>true),
			array('SmallImage,BigImage', 'file', 'types'=>'jpg, gif, png','maxSize'=>1024*500, 'tooLarge'=>'The file was larger than 500KB. Please upload a smaller file.', 'allowEmpty' => true),
			array('Title, Alias,Url,WapUrl,Target,JoinType', 'length', 'max'=>255),
			array('UserId', 'length', 'max'=>20),
			//array(' ActiveStartDate,ActiveEndDate', 'date','format'=>'yyyy-M-d'),
			array('Tags, Description ,Content,CreatedDate, ActiveStartDate,ActiveEndDate,UpdatedDate,ActType,Target,NewHot,IsWebImage,IsWebList,IsWapImage,IsWapList,IsWapIndex', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Title, Tags, Content,City, Status, CreatedDate, UpdatedDate, UserId,  CateId, SmallImage, BigImage,ActType,Target,NewHot,IsWebImage,IsWebList,IsWapImage,IsWapList,IsWapIndex', 'safe', 'on'=>'search'),
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
			'Title' => '标题',
			'Alias' => '别名',
			'Tags' => '标签',
		    'Description' => '描述',
			'Content' => '内容',
			'Status' => '状态',
			'Url' => 'web跳转地址,必须以http://+二级域名的形式',
		    'WapUrl' => 'wap跳转地址',
			'CreatedDate' => '创建时间',
			'UpdatedDate' => '更新时间',
			'UserId' => '发布者id',
			'Views' => '浏览次数',
			'Useful' => '支持次数',
			'Unuseful' => '反对次数',
			'CateId' => '分类Id',
			'SmallImage' => '小图',
			'BigImage' => '大图',
		    'City'=>'地区',
		    'Uid'=>'用户Id',
		    'ActiveStartDate'=>'活动开始时间',
		    'ActiveEndDate'=>'活动结束时间',
		    'ActType'=>'活动类型',
		    'Target'=>'活动对象',
		    'JoinType'=>'参与方式',
		    'NewHot'=>'新建或者热门',
		    'IsWebImage'=>'图文形式推荐到web频道',
			'IsWebList'=>'列表形式推荐到web频道',
			'IsWapImage'=>'图文形式推荐到wap频道',
			'IsWapList'=>'列表形式推荐到wap频道',
			'IsWapIndex'=>'推荐到wap网站首页',
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

		$criteria->compare('t.Id',$this->Id);
		$criteria->compare('t.Title',$this->Title,true);
		$criteria->compare('t.Tags',$this->Tags,true);
		$criteria->compare('t.Status',$this->Status);
		$criteria->compare('t.Target',$this->Target,true);
		$criteria->compare('t.CateId',$this->CateId);
		
		$this->IsWebImage==1 && $criteria->compare('t.IsWebImage',$this->IsWebImage);
		$this->IsWebList==1 && $criteria->compare('t.IsWebList',$this->IsWebList);
		$this->IsWapImage==1 && $criteria->compare('t.IsWapImage',$this->IsWapImage);
		$this->IsWapList==1 && $criteria->compare('t.IsWapList',$this->IsWapList);
		$this->IsWapIndex==1 && $criteria->compare('t.IsWapIndex',$this->IsWapIndex);
		
	    $this->City !=111 && $criteria->compare('t.City',$this->City);
		$this->ActType != 1 && $criteria->compare('t.ActType',$this->ActType);
		$this->NewHot != 1 && $criteria->compare('t.NewHot',$this->NewHot);
		
        $criteria->select='t.Id,t.Title as Title,t.Url,t.Status,B.Title as CTitle';
        $criteria->join='LEFT JOIN categories  B ON t.CateId=B.ID';
        $criteria->order = 't.id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/*public function getCate($id){
		
	}*/
public function generateRandomName($intType)
{
    $strFileName = '';
    switch ($intType) {
        case 0: //map cover image
        $strFileName.='mapCover_';
        $strEnd = '.jpg';
        break;

        case 1: //map description swf
        $strFileName.='mapMovie_';
        $strEnd = '.swf';
        break;

        case 2: //map description image
        $strFileName.='mapImage_';
        $strEnd = '.jpg';
        break;

        case 3: //map version file
        $strFileName.='mapFile_';
        $strEnd = '.rar';
        break;

        default://default name
        $strFileName.='mapUpload_';
        $strEnd = '.unknown';
        break;
    }

    $strFileName.=time().'_';

    $strFileName.=$this->randStr();

    $strFileName.=$strEnd;

    return $strFileName;
}

function randStr($len=6,$format='ALL_WORD') {
     switch($format) {
     case 'ALL_WORD':
     $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; break;
     case 'ALL':
     $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; break;
     case 'CHAR':
     $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
     case 'NUMBER':
     $chars='0123456789'; break;
     default :
     $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
     break;
     }

     mt_srand((double)microtime()*1000000*getmypid());
     $password="";
     while(strlen($password)<$len)
        $password.=substr($chars,(mt_rand()%strlen($chars)),1);
     return $password;
 }
 public static function getStatus($stauts){
 	if($stauts==2){ 
 	   return '发布';
 	}else{
 		return '关闭';
 	}
 	
 	
 }
}