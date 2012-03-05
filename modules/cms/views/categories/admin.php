<?php
$this->breadcrumbs=array(
	'分类'=>array('admin'),
	'管理',
);

$this->menu=array(
	array('label'=>'List Categories', 'url'=>array('index')),
	array('label'=>'Create Categories', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('categories-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>分类管理</h1>

<p>
你可以输入 (<, <=, >, >=, <> or =) 这些等式来查询数据.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo CHtml::link('新增分类','create',array('class'=>'button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
echo MHtml::activeCategories($model, 'ParentId',$category,$Tree,array('href'=>'true','type'=>4)); ?>
<?php //echo $form->error($model,'ParentId'); ?>
<div class="search-form" style="display:none">
<?php
   
    $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php //$data=$model->search();
//print_r($data);exit;
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Id',
		'Title',
		'Alias',
		'Description',
		//'Image',
        // $cateMap[ParentId],
       array('name'=>'ParentId','htmlOptions'=>array('style'=>'width:50px;text-align: center;')),
       array('header'=>'父类名称', 'type'=>'raw','value'=>'Categories::getPname($data->ParentId)'),
		
		/*
		'IsActive',
		'Ordering',
		*/
		array(
			'class'=>'CButtonColumn',
		    'template'=>'{view} {update}{delete}',
		     
		
		),
	),
)); ?>
