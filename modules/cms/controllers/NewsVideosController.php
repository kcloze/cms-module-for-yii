<?php

class NewsVideosController extends ManagerController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
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
				'actions'=>array('index','view','admin'),
				'users'=>array('admin','cms_admin','delete_admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload'),
				'users'=>array('cms_admin','admin','delete_admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete','deleteAjax'),
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
		$model=new NewsVideos;
        $result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NewsVideos']))
		{   
			 Yii::import('application.extensions.tools.FileTools');
			 $FileTools=new FileTools();
			$model->attributes=$_POST['NewsVideos'];
			 if (@!empty($_FILES['NewsVideos']['name']['VideoThumb'])){
			 	$myPicture=CUploadedFile::getInstance($model,'VideoThumb');
	        	$extName=strtolower($myPicture->getExtensionName());
		    	$dir_time=date('Y').'/'.date('m').'/';
		    	$FileTools->mk_dir(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time);
		    	$fileLastName=$FileTools->generateRandomName($extName);
			   $myPicture->saveAs(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.$fileLastName);
			    $model->VideoThumb=$dir_time.$fileLastName;	
		    }
			
			//date('Y-m-d H:i:s');
			$model->CreateTime=date('Y-m-d H:i:s');
			$model->UserId=Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('update','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,'category' => $category ,'Tree'=>$Tree
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
        $result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NewsVideos']))
		{    			
		    Yii::import('application.extensions.tools.FileTools');
			$FileTools=new FileTools();
			$model->attributes=$_POST['NewsVideos'];
		    if (@!empty($_FILES['NewsVideos']['name']['VideoThumb'])){
			 	$myPicture=CUploadedFile::getInstance($model,'VideoThumb');
	        	$extName=strtolower($myPicture->getExtensionName());
		    	$dir_time=date('Y').'/'.date('m').'/';
		    	$FileTools->mk_dir(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time);
		    	$fileLastName=$FileTools->generateRandomName($extName);
			   $myPicture->saveAs(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.$fileLastName);
			    $model->VideoThumb=$dir_time.$fileLastName;	
		    }
			$model->UpdateTime=date('Y-m-d H:i:s');
			$model->UserId=Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}
		$this->render('update',array(
			'model'=>$model,'category' => $category ,'Tree'=>$Tree
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
     function actionUpload(){
		$Id=isset($_REQUEST['Id'])?$_REQUEST['Id']:'';//图集id
	    $commond=Yii::app()->db->createCommand();
		
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
			    	$userid=Yii::app()->user->id;
	            	$pid=$commond->update('news_videos',array('Video'=>$dir_time.$fileLastName,'UpdateTime'=>date("Y-m-d H:i:s"),'UserId'=>$userid),'Id=:Id', array(':Id'=>$Id));
			    	//if($pid) $pid=Yii::app()->db->getLastInsertID();
			    }
			    echo json_encode(array('video'=>$dir_time.$fileLastName,'vid'=>$Id));
			    Yii::app()->end();
	  }
	}
	public function actionDelete($id)
	{
	
			// we only allow deletion via POST request
			 $this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	
	}
	public function actionDeleteAjax(){
		$id=$_POST['vid'];
		empty($id) && exit;
		$commond=Yii::app()->db->createCommand();
		$commond->select("Video")->from("news_videos")->where('id=:id', array(':id'=>$id));
		$info=$commond->queryRow();
		if(is_array($info)){
			foreach($info as $val){
				$fileDir=Yii::app()->basePath.'/../files/uploadfiles/';
				if(file_exists($fileDir.$val))
			         unlink($fileDir.$val);
		   
			}
			$commond->update("news_videos",array("Video"=>''),'id=:id', array(':id'=>$id));
			echo  1;exit;
		}
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('NewsVideos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NewsVideos('search');
		$result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NewsVideos']))
			$model->attributes=$_GET['NewsVideos'];

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
		$model=NewsVideos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-videos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
