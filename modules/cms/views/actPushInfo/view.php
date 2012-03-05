<?php
$this->breadcrumbs=array(
	'Act Push Infos'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ActPushInfo', 'url'=>array('index')),
	array('label'=>'Create ActPushInfo', 'url'=>array('create')),
	array('label'=>'Update ActPushInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ActPushInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ActPushInfo', 'url'=>array('admin')),
);
?>

<h1>View ActPushInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'remark',
		'push_num',
		'status',
		'c_time',
	),
)); ?>
