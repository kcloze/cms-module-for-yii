<?php
$this->breadcrumbs=array(
	'分类管理'=>array('admin'),
	$model->Title=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Categories', 'url'=>array('index')),
	array('label'=>'Create Categories', 'url'=>array('create')),
	array('label'=>'View Categories', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>更新分类 <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'category' => $category,'Tree'=>$Tree)); ?>