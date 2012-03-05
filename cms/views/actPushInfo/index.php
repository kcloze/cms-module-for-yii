<?php
$this->breadcrumbs=array(
	'Act Push Infos',
);

$this->menu=array(
	array('label'=>'Create ActPushInfo', 'url'=>array('create')),
	array('label'=>'Manage ActPushInfo', 'url'=>array('admin')),
);
?>

<h1>Act Push Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
