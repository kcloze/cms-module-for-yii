<?php
$this->breadcrumbs=array(
	'图集管理'=>array('admin'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List NewsImagesCate', 'url'=>array('index')),
	array('label'=>'Create NewsImagesCate', 'url'=>array('create')),
	array('label'=>'Update NewsImagesCate', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete NewsImagesCate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NewsImagesCate', 'url'=>array('admin')),
);
?>

<h1>预览图集<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'CateId',
		'ImageThumbScale',
		'CoverImage',
	),
)); ?>
