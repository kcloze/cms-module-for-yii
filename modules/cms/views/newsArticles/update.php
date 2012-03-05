<?php
$this->breadcrumbs=array(
	'文章'=>array('index'),
	$model->Title=>array('view','id'=>$model->Id),
	'更新',
);

$this->menu=array(
	array('label'=>'List NewsArticles', 'url'=>array('index')),
	array('label'=>'Create NewsArticles', 'url'=>array('create')),
	array('label'=>'View NewsArticles', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage NewsArticles', 'url'=>array('admin')),
);
?>

<h1>更新文章 <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'category' => $category ,'Tree'=>$Tree)); ?>