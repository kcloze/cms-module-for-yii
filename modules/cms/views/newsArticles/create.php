<?php
$this->breadcrumbs=array(
	'文章管理'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NewsArticles', 'url'=>array('index')),
	array('label'=>'Manage NewsArticles', 'url'=>array('admin')),
);
?>

<h1>新建文章</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'category' => $category ,'Tree'=>$Tree)); ?>