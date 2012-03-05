<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
	</div>

     <div class="row">
		<?php echo $form->label($model,'Title'); ?>
		<?php echo $form->textField($model,'Title'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'CateId'); ?>
		<?php echo $form->textField($model,'CateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ImageThumbScale'); ?>
		<?php echo $form->textField($model,'ImageThumbScale',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CoverImage'); ?>
		<?php echo $form->textField($model,'CoverImage',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->