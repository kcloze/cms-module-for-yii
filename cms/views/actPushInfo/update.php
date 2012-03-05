<?php
$this->breadcrumbs=array(
	'Act Push Infos'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ActPushInfo', 'url'=>array('index')),
	array('label'=>'Create ActPushInfo', 'url'=>array('create')),
	array('label'=>'View ActPushInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ActPushInfo', 'url'=>array('admin')),
);
?>

<h1>Update ActPushInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>