<?php
$this->breadcrumbs=array(
	'管理图集'=>array('admin'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NewsImagesCate', 'url'=>array('index')),
	array('label'=>'Create NewsImagesCate', 'url'=>array('create')),
	array('label'=>'View NewsImagesCate', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage NewsImagesCate', 'url'=>array('admin')),
);
?>

<h1>更新图集 <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'category' => $category ,'Tree'=>$Tree,'Pictures'=>$Pictures)); ?>