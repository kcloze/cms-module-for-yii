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
		<?php echo $form->label($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Tags'); ?>
		<?php echo $form->textArea($model,'Tags',array('rows'=>6, 'cols'=>50)); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'City'); ?>
		<?php echo $form->dropDownList($model, 'City',Yii::app()->params['city']); ?>
		<?php echo $form->error($model,'City'); ?>
		
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'ActType'); ?>
		<?php echo $form->dropDownList($model,'ActType',array(
		'1'=>'所有类型',
		'2'=>'歌友会',
		'3'=>'抢话费',
		'4'=>'送豆豆',
		'5'=>'其他',
		)); ?>
		<?php echo $form->error($model,'ActType'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->label($model,'CateId'); ?>
		<?php echo $form->textField($model,'CateId'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->dropDownList($model,'Status',array(
		'2'=>'发布',
		'1'=>'关闭',
		)); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>
	<div class="row">
	<label><strong style="color:red">推荐到：</strong></label>
	</div>
   <div class="recommend">
		<span><?php echo $form->checkBox($model,'IsWebImage'); ?>
        <?php echo $form->label($model,'IsWebImage'); ?>
		<?php echo $form->error($model,'IsWebImage'); ?>
		&nbsp;
		</span>
		<span>
		<?php echo CHtml::activeCheckBox($model,'IsWebList'); ?>
        <?php echo CHtml::activeLabel($model,'IsWebList'); ?>
		<?php echo $form->error($model,'IsWebList'); ?>
		&nbsp;
		</span>
		<span>
		<?php echo CHtml::activeCheckBox($model,'IsWapImage'); ?>
        <?php echo CHtml::activeLabel($model,'IsWapImage'); ?>
		<?php echo $form->error($model,'IsWapImage'); ?>
		&nbsp;
		</span>
		<span>
		<?php echo CHtml::activeCheckBox($model,'IsWapList'); ?>
        <?php echo CHtml::activeLabel($model,'IsWapList'); ?>
		<?php echo $form->error($model,'IsWapList'); ?>
		&nbsp;
		</span>
		<span>
		<?php echo CHtml::activeCheckBox($model,'IsWapIndex'); ?>
        <?php echo CHtml::activeLabel($model,'IsWapIndex'); ?>
		<?php echo $form->error($model,'IsWapIndex'); ?>
		&nbsp;
		</span>
		
	</div>
	<div class="row">
		<?php echo $form->label($model,'NewHot'); ?>
		<?php echo $form->dropDownList($model,'NewHot',array(
		'1'=>'Default',
		'2'=>'New',
		'3'=>'Hot',
		'4'=>'New and Hot',
		)); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->