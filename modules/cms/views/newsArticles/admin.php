<?php
$this->breadcrumbs=array(
	'文章'=>array('admin'),
	'文章管理',
);

$this->menu=array(
	array('label'=>'List NewsArticles', 'url'=>array('index')),
	array('label'=>'Create NewsArticles', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-articles-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>文章管理</h1>

<p>
你可以输入 (<, <=, >, >=, <> or =) 这些等式来查询数据.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo CHtml::link('新增文章','create',array('class'=>'button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
echo MHtml::activeCategories($model, 'CateId',$category,$Tree,array('href'=>'true','type'=>3)); ?>
<?php //echo $form->error($model,'ParentId'); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-articles-grid',
	'dataProvider'=>$model->search(),
    'ajaxUpdate'=>false,
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'Id','htmlOptions'=>array('style'=>'width:20px;text-align: center;')),
		array('name'=>'Title','htmlOptions'=>array('style'=>'width:200px'),),
		//'Alias',
	   array('header'=>'分类名称', 'type'=>'raw','value'=>'$data->CTitle','htmlOptions'=>array('style'=>'width:50px;text-align: center;')),
		
		array('name'=>'Url','htmlOptions'=>array('style'=>'width:50px;text-align: center;'),),
		
		//'Tags',
		//'Content',
		array('name'=>'Status','htmlOptions'=>array('style'=>'width:50px;text-align: center;'),
		'value'=>'NewsArticles::getStatus($data->Status)'),
		
		/*
		'IsFeatured',
		'CreatedDate',
		'UpdatedDate',
		'UserId',
		'Views',
		'Useful',
		'Unuseful',
		'CateId',
		
		'SmallImage',
		'BigImage',
		*/
		array(
			'class'=>'CButtonColumn',
		   'template'=>'{view} {update}{delete}',
		 
     ),
		
	),
)); ?>
