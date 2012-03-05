<?php
$this->breadcrumbs=array(
	'分类管理'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'List Categories', 'url'=>array('index')),
	array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>创建分类</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'category' => $category ,'Tree'=>$Tree)); ?>