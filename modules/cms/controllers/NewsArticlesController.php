<?php

class NewsArticlesController extends ManagerController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    //public $layout='column2';

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
				'actions'=>array('index','view','admin','test'),
				'users'=>array('admin','cms_admin','delete_admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','getActicleTree'),
				'users'=>array('admin','cms_admin','delete_admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
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
		$model=$this->loadModel($id);
		$model->SmallImage=$model->SmallImage?Yii::app()->request->BaseUrl.'/files/uploadfiles/'.$model->SmallImage:'';
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//显示无限级分类
        $result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree']; 
		$model=new NewsArticles;
        $model->Url=$model->Url?$model->Url:'http://';
        $model->WapUrl=$model->WapUrl?$model->WapUrl:'http://';
        $model->CreatedDate=date('Y-m-d H:i:s');
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NewsArticles']))
		{   
			$model->attributes=$_POST['NewsArticles'];
			//小图
		    if (@!empty($_FILES['NewsArticles']['name']['SmallImage'])){
		    	$dir_time=date('Y').'/'.date('m').'/';
		    	$this->mk_dir(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time);
				$model->SmallImage = $model->generateRandomName(2);
			    $model->uploaded_SmallImage=CUploadedFile::getInstance($model,'SmallImage');
			    $model->uploaded_SmallImage->saveAs(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.$model->SmallImage);
			    $model->SmallImage=$dir_time.$model->SmallImage;	
		    }
		    //大图
		    if (@!empty($_FILES['NewsArticles']['name']['BigImage'])){
		    	$dir_time=date('Y').'/'.date('m').'/';
		    	$this->mk_dir(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time);
		    	$model->BigImage = $model->generateRandomName(2);
		    	$model->uploaded_BigImage=CUploadedFile::getInstance($model,'BigImage');
		    	$model->uploaded_BigImage->saveAs(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.$model->BigImage);
		    	$model->BigImage=$dir_time.$model->BigImage;
		    }
			
			
			$model->UserId=Yii::app()->user->id;
			$model->Url=$model->Url!='http://'?$model->Url:'';
			$model->WapUrl=$model->WapUrl!='http://'?$model->WapUrl:'';
			$city=$model->City;
			$smsPortConfig=Yii::app()->params['smsPort'];
			$model->SmsPort=$smsPortConfig[$city];
			if($model->save()){
				//outlet
				if( isset($_POST['ArticlesTreeTitle']) && is_array($_POST['ArticlesTreeTitle'])
			        && isset($_POST['ArticlesTreeUrl']) && is_array($_POST['ArticlesTreeUrl'])){
			        $command=Yii::app()->db->createCommand();
			    	$treeNum=count($_POST['ArticlesTreeTitle']);
			    	$command->delete('news_articles_tree','AId=:id',array(':id'=>$model->Id));
		    		for($i=0;$i<$treeNum;$i++){
			    		$command->insert('news_articles_tree',array('AId'=>$model->Id,'Title'=>$_POST['ArticlesTreeTitle'][$i],'Url'=>$_POST['ArticlesTreeUrl'][$i]));
			    	}
			    	
			    }
			    //添加活动自动发帖
			    if($_POST['NewsArticles']['CateId']==85){
			    	$content='';
			    	
			    	$model->BigImage && $content='<p><img src="'.Yii::app()->params['basehost'].Yii::app()->request->BaseUrl.'/files/uploadfiles/'.$model->BigImage.'"/></p>';
			    	$startTime=$model->ActiveStartDate?date('Y-m-d',strtotime($model->ActiveStartDate)):'待定';
			    	$endTime=$model->ActiveEndDate?date('Y-m-d',strtotime($model->ActiveEndDate)):'待定';
			    	$content.='<p>活动时间：'.$startTime.'-'.$endTime.'</p>';
			    	$content.='<p>活动目标客户：'.$model->Tags.'</p>';
			    	$content.='<p>'.$model->Content.'</p>';
			 
			    	
			    	UserHelper::mzone_auto_bbs(1,9,3,$_POST['NewsArticles']['Title'],$content);
			    }
			    $this->redirect(array('view','id'=>$model->Id));
			    
			}
		}

		$this->render('create',array(
			'model'=>$model,'category' => $category ,'Tree'=>$Tree));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		//显示无限级分类
        $result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
       $command=Yii::app()->db->createCommand();
		
		if(isset($_POST['NewsArticles']))
		{   
	        
		    if( isset($_POST['ArticlesTreeTitle']) && is_array($_POST['ArticlesTreeTitle'])
		        && isset($_POST['ArticlesTreeUrl']) && is_array($_POST['ArticlesTreeUrl'])){
		    	$treeNum=count($_POST['ArticlesTreeTitle']);
		    	$command->delete('news_articles_tree','AId=:id',array(':id'=>$id));
	    		for($i=0;$i<$treeNum;$i++){
		    		$command->insert('news_articles_tree',array('AId'=>$id,'Title'=>$_POST['ArticlesTreeTitle'][$i],'Url'=>$_POST['ArticlesTreeUrl'][$i]));
		    	}
		    	
		    }
		    
			$model->attributes=$_POST['NewsArticles'];
			//上传图片
			/*//大图
			if (@!empty($_FILES['NewsArticles']['name']['BigImage'])){
				$model->BigImage = $model->generateRandomName(2);
			    $model->uploaded_BigImage=CUploadedFile::getInstance($model,'BigImage');
			    $model->uploaded_BigImage->saveAs(Yii::app()->basePath.'/../uploadfiles/'.$model->BigImage);
			}else{
			$model->BigImage = '';
			}*/
			//小图
		    if (@!empty($_FILES['NewsArticles']['name']['SmallImage'])){
		    	$dir_time=date('Y').'/'.date('m').'/';
		    	$this->mk_dir(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time);
				$model->SmallImage = $model->generateRandomName(2);
			    $model->uploaded_SmallImage=CUploadedFile::getInstance($model,'SmallImage');
			    $model->uploaded_SmallImage->saveAs(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.$model->SmallImage);
	            $model->SmallImage=$dir_time.$model->SmallImage;	
		    }
		    //大图
		    if (@!empty($_FILES['NewsArticles']['name']['BigImage'])){
		    	$dir_time=date('Y').'/'.date('m').'/';
		    	$this->mk_dir(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time);
		    	$model->BigImage = $model->generateRandomName(2);
		    	$model->uploaded_BigImage=CUploadedFile::getInstance($model,'BigImage');
		    	$model->uploaded_BigImage->saveAs(Yii::app()->basePath.'/../files/uploadfiles/'.$dir_time.$model->BigImage);
		    	$model->BigImage=$dir_time.$model->BigImage;
		    }
			$model->UpdatedDate=date('Y-m-d H:i:s');
			$model->UserId=Yii::app()->user->id;
			$model->Url=$model->Url!='http://'?$model->Url:'';
			$model->WapUrl=$model->WapUrl!='http://'?$model->WapUrl:'';
			//sms port
			$city=$model->City;
			$smsPortConfig=Yii::app()->params['smsPort'];
			$model->SmsPort=$smsPortConfig[$city];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->Id));
	       }
		}
		$this->render('update',array(
			'model'=>$model, 'category' => $category ,'Tree'=>$Tree
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionGetActicleTree(){
		$id=$_POST['AId'];
		if($id){
		  $command=Yii::app()->db->createCommand();
		  $articlesTree=$command->select('*')->from('news_articles_tree')->where('AId=:id',array(':id'=>$id))->queryAll();
		  if(count($articlesTree)>0){
		  echo json_encode($articlesTree);exit;
		  }else{
		  	echo 0;exit;
		  }
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('NewsArticles');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        //$this->layout=Yii::app()->layout;exit;
		$model=new NewsArticles('search');
		
		$result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NewsArticles']))
			$model->attributes=$_GET['NewsArticles'];

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
		$model=NewsArticles::model()->findByPk($id);
		if($model===null){
			throw new CHttpException(404,'The requested page does not exist.');
		}else{
			$model->Url=$model->Url?$model->Url:'http://';
			$model->WapUrl=$model->WapUrl?$model->WapUrl:'http://';
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-articles-form')
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
	public function actionTest(){
		//header("Content-type: text/html; charset=utf-8");
		set_time_limit(0);
		$url='http://www.fjmszb.com';
		/*
		 $urls = array("http://www.fjmszb.com/index.php?category");
		$mp = new ClassCurlMulti($urls);
		$mp->start();
		preg_match_all("/<dt><a href=\"(.+?)\" >(.+?)<\/a><\/dt>/is",$mp->content,$art);
		$mp=null;
		$dump_sql='';
		foreach($art_list[2] as $k=>$val){
		$j=$k+1;
		$dou=$k==0?'':',';
		$dump_sql.="$dou(".$j.",'".trim($val)."')";
		}
		$sql="INSERT INTO life_wiki_cate (CateId, Name) VALUES ".$dump_sql;
		$command=Yii::app()->db->createCommand($sql);
		$command->execute();exit; */
		$dump_sql='';
		for($m=50;$m<=55;$m++){
		
			$aurl=$url.'/index.php?category-view-1-'.$m;
			$urls = array($aurl);
			$mp = new ClassCurlMulti($urls);
			$mp->start_one();
			preg_match_all("/<dt class=\"h2\"><a href=\"(.+?)\" >(.+?)<\/a><\/dt>/is",$mp->content,$art_list);
			$mp=null;
			foreach($art_list[1] as $k=>$val){
		
				$urls2[$k]=$aurl=$url.'/'.$val;
		
			}
			$mp = new ClassCurlMulti($urls2);
			$mp->start();
			//echo $mp->content;exit;
			$sql="INSERT INTO life_wiki_content (Title, Content,CateId) VALUES ".$mp->content;
			$command=Yii::app()->db->createCommand($sql);
			$command->execute();
			$m++;
		}
	}
}
