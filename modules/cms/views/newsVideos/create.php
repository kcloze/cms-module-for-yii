<?php
$this->breadcrumbs=array(
	'视频'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'List NewsVideos', 'url'=>array('index')),
	array('label'=>'Manage NewsVideos', 'url'=>array('admin')),
);
?>

<h1>创建视屏</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'category' => $category ,'Tree'=>$Tree)); ?>