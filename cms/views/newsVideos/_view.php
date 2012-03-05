<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VId')); ?>:</b>
	<?php echo CHtml::encode($data->VId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CateId')); ?>:</b>
	<?php echo CHtml::encode($data->CateId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
	<?php echo CHtml::encode($data->Title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VideoThumb')); ?>:</b>
	<?php echo CHtml::encode($data->VideoThumb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Video')); ?>:</b>
	<?php echo CHtml::encode($data->Video); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateTime')); ?>:</b>
	<?php echo CHtml::encode($data->CreateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdateTime')); ?>:</b>
	<?php echo CHtml::encode($data->UpdateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserId')); ?>:</b>
	<?php echo CHtml::encode($data->UserId); ?>
	<br />

	*/ ?>

</div>