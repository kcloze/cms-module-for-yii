<?php
$this->breadcrumbs=array(
	'图集管理'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'图集列表', 'url'=>array('index')),
	array('label'=>'管理图集', 'url'=>array('admin')),
);
?>

<h1>创建图集</h1>

<?php echo $this->renderPartial('_formCreate', array('model'=>$model, 'category' => $category ,'Tree'=>$Tree,'ImageThumbScale2'=>$ImageThumbScale2)); ?>