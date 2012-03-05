<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-images-cate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	 
	echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'Title'); ?>
		<?php echo $form->textField($model,'Title'); ?>
		<?php echo $form->error($model,'Title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CateId'); ?>
		<?php echo MHtml::activeCategories($model, 'CateId',$category,$Tree,array('type'=>2)); ?>
		<?php echo $form->error($model,'CateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ImageThumbScale'); 
		?>
		<?php echo $form->textField($model,'ImageThumbScale',array('name'=>'ImageThumbScaleW','id'=>'ImageThumbScaleW','size'=>5,'maxlength'=>10,'value'=>$ImageThumbScale2[0])); ?>
		*
		<?php echo $form->textField($model,'ImageThumbScale',array('name'=>'ImageThumbScaleH','id'=>'ImageThumbScaleH','size'=>5,'maxlength'=>10,'value'=>$ImageThumbScale2[1])); ?>
		
		<?php echo $form->error($model,'ImageThumbScale'); ?>
	</div>
	
   

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->