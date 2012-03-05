<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'act-push-info-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'push_num'); ?>
		<?php echo $form->textField($model,'push_num',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'push_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(
		'0'=>'启用',
		'1'=>'停用',
		)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
	<?php
// 	    echo $form->labelEx($model,'c_time');
// 		$this->widget('ext.my97.JMy97DatePicker',array(
// 	    'name'=>CHtml::activeName($model,'c_time'),
// 	    'value'=>$model->c_time,
// 	    'options'=>array('dateFmt'=>'yyyy-MM-dd HH:mm:ss'),
// 	    ));
// 	    $form->error($model,'c_time');
	 ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->