<?php

class NewsImagesCateController extends ManagerController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	function init(){
	  if(isset($_POST['SESSION_ID'])){
	    $session=Yii::app()->getSession();
	    $session->close();
	    $session->sessionID = $_POST['SESSION_ID'];
	    $session->open();
	  }
	}
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','upload','admin'),
				'users'=>array('admin','cms_admin','delete_admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload'),
				'users'=>array('cms_admin','admin','delete_admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','deleteAjax'),
				'users'=>array('delete_admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new NewsImagesCate();
		$cookie = Yii::app()->request->getCookies();
		//unset($cookie['ImageThumbScale']);
		$ImageThumbScale = (isset($cookie['ImageThumbScale']->value)) ? $cookie['ImageThumbScale']->value : '139*91';
		$ImageThumbScale2=explode('*',$ImageThumbScale);
		
        $result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        //var_dump($model);exit;
		if(isset($_POST['NewsImagesCate']))
		{
			//$_POST['NewsImagesCate']['id']=$_POST['NewsImagesCate']['mid'];
			//unset($_POST['NewsImagesCate']['mid']);
			$_POST['NewsImagesCate']['ImageThumbScale']=$_POST['ImageThumbScaleW'].'*'.$_POST['ImageThumbScaleH'];
			$_POST['NewsImagesCate']['CoverImage']=1;
			$model->attributes=$_POST['NewsImagesCate'];
			if($model->save()){
				//写cookie记录图片压缩比例
				$cookie = new CHttpCookie('ImageThumbScale', $_POST['NewsImagesCate']['ImageThumbScale']);
				$cookie->expire = time()+60*60*24*180;
				Yii::app()->request->cookies['ImageThumbScale']=$cookie;
				$this->redirect(array('update','id'=>$model->Id));
			}
		}

		$this->render('create',array(
			'model'=>$model, 'category' => $category ,'Tree'=>$Tree,'ImageThumbScale2'=>$ImageThumbScale2
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{   
		$model=$this->loadModel($id);
		 $commond=Yii::app()->db->createCommand();
		 $commond->select("Id,CateId,Title,Description,ImageThumb,Image")->from("news_images")->where('MId=:id', array(':id'=>$id));
		 $Pictures=$commond->queryAll();
        $result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['NewsImagesCate']))
		{
			$_POST['NewsImagesCate']['id']=$_POST['NewsImagesCate']['mid'];
			unset($_POST['NewsImagesCate']['mid']);
			$_POST['NewsImagesCate']['ImageThumbScale']=$_POST['ImageThumbScaleW'].'*'.$_POST['ImageThumbScaleH'];
			!isset($_POST['NewsImagesCate']['CoverImage']) && $_POST['NewsImagesCate']['CoverImage']='';
			$model->attributes=$_POST['NewsImagesCate'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}
		
		$this->render('update',array(
			'model'=>$model,'category' => $category ,'Tree'=>$Tree,'Pictures'=>$Pictures
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		
		
	}
	public function actionDeleteAjax(){
		$id=$_POST['pid'];
		empty($id) && exit;
		$commond=Yii::app()->db->createCommand();
		$commond->select("ImageThumb,Image")->from("news_images")->where('id=:id', array(':id'=>$id));
		$info=$commond->queryRow();
		$return=$commond->delete('news_images', 'id=:id', array(':id'=>$id));
		if(is_array($info)){
			foreach($info as $val){
				$fileDir=Yii::app()->basePath.'/../files/uploadfiles/';
				if(file_exists($fileDir.$val))
			         unlink($fileDir.$val);
		   
			}
		}
		echo $return;exit;
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('NewsImagesCate');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	function actionUpload(){
		$imgw=isset($_REQUEST['imgw'])?$_REQUEST['imgw']:'';
		$imgh=isset($_REQUEST['imgh'])?$_REQUEST['imgh']:'';
		$cateId=isset($_REQUEST['cateId'])?$_REQUEST['cateId']:'';//分类id
		$mId=isset($_REQUEST['mId'])?$_REQUEST['mId']:'';//图集id
	    $commond=Yii::app()->db->createCommand();
		if(empty($mId)){
			//新建图集
			empty($cateId) && exit;
			$mId=$commond->insert('news_images_cate',
			   array('CateId'=>$cateId,'Title'=>'默认')
			);
			$mId && $mId=Yii::app()->db->getLastInsertID();
		}
		if(!isset($_COOKIE['imgew_cookie']))
		   setcookie('imgew_cookie',$imgw,time()+60*60*24*30);
		if(!isset($_COOKIE['imgeh_cookie']))
		   setcookie('imgeh_cookie',$imgh,time()+60*60*24*30);
		
	  Yii::import('application.extensions.tools.FileTools');
	  $FileTools=new FileTools();
	  if(isset($_POST['myPicture'])){
	        	$myPicture=CUploadedFile::getInstanceByName('myPicture');
	        	$extName=strtolower($myPicture->getExtensionName());
	         	$dir_time=date('Y').'/'.date('m').'/';
		    	$FileTools->mk_dir(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.'/thumb/');
		    	$fileLastName=$FileTools->generateRandomName($extName);
		    	$thumbDir=Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.'/thumb/';
		    	$savePath=Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.$fileLastName;
			    if(!$myPicture->saveAs($savePath)){
			      throw new CHttpException(500);
			    }else{
			    	$FileTools->makethumb($savePath,$thumbDir,$imgw,$imgh);
			    	$userid=Yii::app()->user->id;
			    	//$insertSql="INSERT INTO mzone_act.news_images ( CateId,Image,CreateTime,UserId)VALUES($cateId,$dir_time.$fileLastName,date('Y-m-d H:i:s'),$userid);";
	            	$pid=$commond->insert('news_images',array('MId'=>$mId,'CateId'=>$cateId,'Image'=>$dir_time.$fileLastName,'ImageThumb'=>$dir_time.'thumb/'.$fileLastName,'CreateTime'=>date("Y-m-d H:i:s"),'UserId'=>$userid));
			    	if($pid) $pid=Yii::app()->db->getLastInsertID();
			    }
			    echo json_encode(array('img'=>$dir_time.$fileLastName,'pimg'=>'pimg_'.$pid,'pid'=>$pid,'mid'=>$mId));
			    Yii::app()->end();
	  }
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NewsImagesCate('search');
		$result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NewsImagesCate']))
			$model->attributes=$_GET['NewsImagesCate'];

		$this->render('admin',array(
			'model'=>$model, 'category' => $category ,'Tree'=>$Tree
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=NewsImagesCate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-images-cate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
   //循环生成文件夹
	public function mk_dir($dir, $mode = 0755) 
	{ 
  	  if (is_dir($dir) || @mkdir($dir,$mode)) return true; 
	  if (!$this->mk_dir(dirname($dir),$mode)) return false; 
	  return @mkdir($dir,$mode); 
	} 
	public function getCategories(){
		//显示无限级分类
        $command = Yii::app ()->db->createCommand ( 'SELECT id,title,parentId FROM categories where IsActive=2' );
		$categories = $command->queryAll ();
		Yii::import('application.extensions.tree.Tree');
        $Tree = new Tree();
        if(is_array($categories)){
	     	foreach($categories as $val){
				$Tree->setNode($val['id'],$val['parentId'],$val['title']); 
			}
        }
        $category = $Tree->getChilds(); 
        return array('category'=>$category,'Tree'=>$Tree);
	}
}
