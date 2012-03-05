<?php
$this->breadcrumbs=array(
	'Act Push Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ActPushInfo', 'url'=>array('index')),
	array('label'=>'Manage ActPushInfo', 'url'=>array('admin')),
);
?>

<h1>Create ActPushInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>