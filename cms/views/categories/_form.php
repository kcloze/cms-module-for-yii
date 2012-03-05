<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Alias'); ?>
		<?php echo $form->textField($model,'Alias',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Alias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ParentId'); ?>
		<?php echo MHtml::activeCategories($model, 'ParentId',$category,$Tree,array()); ?>
		<?php echo $form->error($model,'ParentId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IsActive'); ?>
		<?php echo $form->dropDownList($model,'IsActive',array(
		'2'=>'有效',
		'1'=>'无效',
		)); ?>
		<?php echo $form->error($model,'IsActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Ordering'); ?>
		<?php echo $form->textField($model,'Ordering'); ?>
		<?php echo $form->error($model,'Ordering'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->