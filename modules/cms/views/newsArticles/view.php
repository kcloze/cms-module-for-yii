<?php
$this->breadcrumbs=array(
	'文章管理'=>array('admin'),
	$model->Title,
);

$this->menu=array(
	array('label'=>'List NewsArticles', 'url'=>array('index')),
	array('label'=>'Create NewsArticles', 'url'=>array('create')),
	array('label'=>'Update NewsArticles', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete NewsArticles', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NewsArticles', 'url'=>array('admin')),
);
?>

<h1>查看文章 #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'Title',
		'Alias',
		'Tags',
		'Content',
		'Status',
		'Url',
		'CreatedDate',
		'UpdatedDate',
        'ActiveStartDate',
        'ActiveEndDate',
		'UserId',
		'Views',
		'Useful',
		'Unuseful',
		'CateId',
		'SmallImage',
		'BigImage',
        'Uid',
	),
)); ?>
