<?php
$this->breadcrumbs=array(
	'分类',
);

$this->menu=array(
	array('label'=>'Create Categories', 'url'=>array('create')),
	array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>分类</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
