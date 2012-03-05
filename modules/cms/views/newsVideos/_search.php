<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Id'); ?>
		<?php echo $form->textField($model,'Id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VId'); ?>
		<?php echo $form->textField($model,'VId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CateId'); ?>
		<?php echo $form->textField($model,'CateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VideoThumb'); ?>
		<?php echo $form->textField($model,'VideoThumb',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Video'); ?>
		<?php echo $form->textField($model,'Video',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreateTime'); ?>
		<?php echo $form->textField($model,'CreateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UpdateTime'); ?>
		<?php echo $form->textField($model,'UpdateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserId'); ?>
		<?php echo $form->textField($model,'UserId',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->