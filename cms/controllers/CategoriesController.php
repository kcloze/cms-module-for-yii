<?php

class CategoriesController extends ManagerController {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout = '//layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters() {
		return array ('accessControl' )// perform access control for CRUD operations
;
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','admin'),
				'users'=>array('admin','cms_admin','delete_admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('admin','delete_admin'),
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
	public function actionView($id) {
		$this->render ( 'view', array ('model' => $this->loadModel ( $id ) ) );
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$result=$this->getCategories(true);
		$category=$result['category'];
		$Tree=$result['Tree']; 
	
		$model = new Categories ();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		

		if (isset ( $_POST ['Categories'] )) {
			$model->attributes = $_POST ['Categories'];
			if ($model->save ())
				$this->redirect ( array ('view', 'id' => $model->Id ) );
		}
		
		$this->render ( 'create', array ('model' => $model,'category' => $category ,'Tree'=>$Tree ) );
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id );
		$result=$this->getCategories(true);
		$category=$result['category'];
		$Tree=$result['Tree'];
	
 
		if (isset ( $_POST ['Categories'] )) {
			$model->attributes = $_POST ['Categories'];
			if ($model->save ())
				$this->redirect ( array ('view', 'id' => $model->Id ) );
		}
		
		$this->render ( 'update', array ('model' => $model, 'category' => $category ,'Tree'=>$Tree) );
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		
		//if (Yii::app ()->request->isPostRequest) {
			
		$results=$this->getCategories(false,$id);
		$category=$results['category'];
        if(!empty($category)){
        $delId=implode($category, ',').','.$id;
        }else{
        	$delId=$id;
        }
        
        $deleteSql='delete from categories where id in ('.$delId.')';
        $result=Yii::app ()->db->createCommand($deleteSql)->execute();
      
        if($result){
        	$this->redirect(array ('admin','categories[ParentId]'=>$id));
        }else{
        	echo '无法删除，出错！';
        }
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			//if (! isset ( $_GET ['ajax'] ))
			//	$this->redirect ( isset ( $_POST ['returnUrl'] ) ? $_POST ['returnUrl'] : array ('admin' ) );
		//} else
			//throw new CHttpException ( 400, 'Invalid request. Please do not repeat this request again.' );
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider ( 'Categories' );
		$this->render ( 'index', array ('dataProvider' => $dataProvider ) );
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		
		$model = new Categories ( 'search' );
		//显示树形分类
		$result=$this->getCategories();
		$category=$result['category'];
		$Tree=$result['Tree'];
		$model->unsetAttributes (); // clear any default values
		if (isset( $_GET['Categories'] )){			
			$model->attributes = $_GET['Categories'];
	    }else{
	    	$model->ParentId='';
	    }
		$this->render ( 'admin', array ('model' => $model, 'category' => $category ,'Tree'=>$Tree) );
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model = Categories::model ()->findByPk ( $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'categories-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	}
   public function getCategories($active=false,$pid=0){
		//显示无限级分类
		$where=$active?' where IsActive=2 ':'';
        $command = Yii::app ()->db->createCommand ( 'SELECT id,title,parentId FROM categories '.$where );
        $categories = $command->queryAll ();
		Yii::import('application.extensions.tree.Tree');
        $Tree = new Tree();
        if(is_array($categories)){
	     	foreach($categories as $val){
				$Tree->setNode($val['id'],$val['parentId'],$val['title']); 
			}
        }
        $category = $Tree->getChilds($pid); 
        return array('category'=>$category,'Tree'=>$Tree);
	}
	
}

	

