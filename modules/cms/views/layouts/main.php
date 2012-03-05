<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>array(
				array('label'=>'活动管理','url'=>array('/manager/activity/admin'), 'items'=>array(
					array('label'=>'活动列表','url'=>array('/manager/activity/admin')),
					array('label'=>'新建活动','url'=>array('/manager/activity/create')),
				)),
                /*array('label'=>'表单管理','url'=>array('smartform/admin'), 'items'=>array(
                    array('label'=>'管理表单','url'=>array('smartform/admin')),
                    array('label'=>'新建表单','url'=>array('smartform/create')),
                )),*/
				array('label'=>'抽奖活动','url'=>array('/manager/lotteryactivity/admin'), 'items'=>array(
					array('label'=>'管理抽奖','url'=>array('/manager/lotteryactivity/admin')),
					array('label'=>'新建抽奖','url'=>array('/manager/lotteryactivity/create')),
				)),
				array('label'=>'内容管理','url'=>array('/cms/newsArticles/admin'), 'items'=>array(
					array('label'=>'分类','url'=>array('/cms/categories/admin')),	
					array('label'=>'文章','url'=>array('/cms/newsArticles/admin')),
					
					array('label'=>'图集','url'=>array('/cms/newsImagesCate/admin')),
					array('label'=>'视频','url'=>array('/cms/newsVideos/admin')),
					array('label'=>'短信平台','url'=>array('/cms/actPushInfo/admin')),
					array('label'=>'清空缓存','url'=>array('/cms/actPushInfo/memDelete')),
				)),
               
				array('label'=>'帐号管理', 'url'=>array('/manager/admin/admin')),
				array('label'=>'Login', 'url'=>array('/manager/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/manager/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> 动感地带.<br/>
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>