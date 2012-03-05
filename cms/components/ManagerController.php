<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ManagerController extends  CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */	
	public $layout='/layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    /**
    * put your comment there...
    * 
    * @var CClientScript $clientScript;
    */
    public $clientScript = null;
    
    /**
    * put your comment there...
    * 
    * @var CHttpRequest $request
    */
    public $request = null;
    
    /**
    * put your comment there...
    * 
    * @var CWebUser $user
    */
    public $user = null;
    
    public $jquery_ui_theme = 'south-street';
    
    public function init()
    {
        $this->request = Yii::app()->request;
        $this->clientScript = Yii::app()->clientScript;
        $this->user = Yii::app()->user;

        //register google js api
        $this->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-1.4.2.min.js');
        $this->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-ui.min-1.8.6.js');
        
        //注册js
        //$this->clientScript->registerCoreScript('jquery');
        //$this->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery-ui.min.js');
        //$this->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.autocomplete.min.js');
        
        //注册css
        $this->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/' . $this->jquery_ui_theme . '/jquery-ui.css');
        
        //$baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview';
        //$cssFile=$baseScriptUrl.'/styles.css';
        //Yii::app()->getClientScript()->registerCssFile($cssFile);
    }
    
}