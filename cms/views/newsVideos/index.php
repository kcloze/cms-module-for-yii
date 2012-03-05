<?php
$this->breadcrumbs=array(
	'视频',
);

$this->menu=array(
	array('label'=>'创建视频', 'url'=>array('create')),
	array('label'=>'管理视频', 'url'=>array('admin')),
);
?>

<h1>视频浏览</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
