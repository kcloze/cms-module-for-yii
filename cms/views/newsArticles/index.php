<?php
$this->breadcrumbs=array(
	'文章',
);

$this->menu=array(
	array('label'=>'新建文章', 'url'=>array('create')),
	array('label'=>'文章管理', 'url'=>array('admin')),
);
?>

<h1>News Articles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
