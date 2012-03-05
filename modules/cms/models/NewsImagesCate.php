<?php

/**
 * This is the model class for table "news_images_cate".
 *
 * The followings are the available columns in table 'news_images_cate':
 * @property integer $Id
 * @property integer $CateId
 * @property string $ImageThumbScale
 * @property string $CoverImage
 */
class NewsImagesCate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NewsImagesCate the static model class
	 */
	public $myPicture;
	public $uploaded_myPicture;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news_images_cate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CateId, CoverImage,Title', 'required'),
			array('CateId,CoverImage', 'numerical', 'integerOnly'=>true),
			array('ImageThumbScale', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, CateId, Title,ImageThumbScale, CoverImage', 'safe', 'on'=>'search'),
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
		    'Title'=>'名称',
			'CateId' => '分类',
			'ImageThumbScale' => '压缩比例',
			'CoverImage' => '封面',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('Title',$this->Title);
		$criteria->compare('CateId',$this->CateId);
		$criteria->compare('ImageThumbScale',$this->ImageThumbScale,true);
		$criteria->compare('CoverImage',$this->CoverImage,true);
        $criteria->order = 'id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
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
}