<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-videos-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'CateId'); ?>
		<?php echo MHtml::activeCategories($model, 'CateId',$category,$Tree,array('type'=>2)); ?>
		<?php echo $form->error($model,'CateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VideoThumb'); ?>
       <?php echo CHtml::activeFileField($model, 'VideoThumb',array(),$model->VideoThumb); ?>		
       <?php echo $form->error($model,'VideoThumb'); ?>
	</div>
    <?php if (!empty($model->VideoThumb)){?>
    <div class="row">
     <div style="padding: 1em 0 0 160px;">
				    <img width="150" height="100" src="<?php echo Yii::app()->request->BaseUrl.'/files/uploadfiles/'. $model->VideoThumb ?>" /> &nbsp;
	</div>
    </div>
    <?php }?>
	<div class="row">
	<input id="NewsVideos_Video" type="hidden" name="NewsVideos[Video]" value="0">
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->