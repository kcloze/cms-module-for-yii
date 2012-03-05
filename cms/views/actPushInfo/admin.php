<?php
$this->breadcrumbs=array(
	'活动短信'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'List ActPushInfo', 'url'=>array('index')),
	array('label'=>'Create ActPushInfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('act-push-info-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>活动短信管理</h1>

<p>
你可以输入 (<, <=, >, >=, <> or =) 这些等式来查询数据.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo CHtml::link('新增短信管理','create',array('class'=>'button')); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'act-push-info-grid',
	'dataProvider'=>$model->search(),
	'ajaxUpdate'=>true,
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		array('name'=>'remark','htmlOptions'=>array('style'=>'width:800px;'),
				'value'=>'$data->remark'),
		
		'push_num',
		array('name'=>'status','htmlOptions'=>array('style'=>'width:20px;text-align: center;'),
					'value'=>'ActPushInfo::getStatus($data->status)'),
		'c_time',
		array(
			'class'=>'CButtonColumn',
		),
		
	),
)); ?>
