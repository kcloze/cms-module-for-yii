<?php
$this->breadcrumbs=array(
	'视频管理'=>array('admin'),
	$model->Title=>array('view','id'=>$model->Id),
	' 更新',
);

$this->menu=array(
	array('label'=>'List NewsVideos', 'url'=>array('index')),
	array('label'=>'Create NewsVideos', 'url'=>array('create')),
	array('label'=>'View NewsVideos', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage NewsVideos', 'url'=>array('admin')),
);
?>

<h1>更新视频 <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model, 'category' => $category ,'Tree'=>$Tree)); ?>