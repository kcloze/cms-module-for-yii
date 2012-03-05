<?php
$this->breadcrumbs=array(
	'视频'=>array('index'),
	$model->Title,
);

$this->menu=array(
	array('label'=>'List NewsVideos', 'url'=>array('index')),
	array('label'=>'Create NewsVideos', 'url'=>array('create')),
	array('label'=>'Update NewsVideos', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete NewsVideos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NewsVideos', 'url'=>array('admin')),
);
?>

<h1>View NewsVideos #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'VId',
		'CateId',
		'Title',
		'Description',
		'VideoThumb',
		'Video',
		'CreateTime',
		'UpdateTime',
		'UserId',
	),
)); ?>
