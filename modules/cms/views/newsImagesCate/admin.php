<?php
$this->breadcrumbs=array(
	'图集'=>array('admin'),
	'管理图集',
);

$this->menu=array(
	array('label'=>'图集列表', 'url'=>array('index')),
	array('label'=>'新建图集', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-images-cate-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>图集管理</h1>

<p>
你可以输入 (<, <=, >, >=, <> or =) 这些等式来查询数据.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo CHtml::link('新增图集','create',array('class'=>'button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
echo MHtml::activeCategories($model, 'CateId',$category,$Tree,array('href'=>'true','type'=>3)); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-images-cate-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
        'Title',
		'CateId',
		'ImageThumbScale',
		'CoverImage',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}{delete}',
		),
	),
)); ?>
