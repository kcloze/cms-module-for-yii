<?php
$this->breadcrumbs=array(
	'News Images Cates',
);

$this->menu=array(
	array('label'=>'新建图集', 'url'=>array('create')),
	array('label'=>'管理图集', 'url'=>array('admin')),
);
?>

<h1>图集预览</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
