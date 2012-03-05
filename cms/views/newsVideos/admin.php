<?php
$this->breadcrumbs=array(
	'视频'=>array('admin'),
	'管理',
);

$this->menu=array(
	array('label'=>'List NewsVideos', 'url'=>array('index')),
	array('label'=>'Create NewsVideos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-videos-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理视频</h1>

<p>
你可以输入 (<, <=, >, >=, <> or =) 这些等式来查询数据.</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo CHtml::link('新增视频','create',array('class'=>'button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
echo MHtml::activeCategories($model, 'CateId',$category,$Tree,array('href'=>'true','type'=>3)); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-videos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
		//'VId',
		'CateId',
		'Title',
		'Description',
		'VideoThumb',
		/*
		'Video',
		'CreateTime',
		'UpdateTime',
		'UserId',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
