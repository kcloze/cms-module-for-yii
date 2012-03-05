<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
	<?php echo CHtml::encode($data->Title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Alias')); ?>:</b>
	<?php echo CHtml::encode($data->Alias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tags')); ?>:</b>
	<?php echo CHtml::encode($data->Tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Content')); ?>:</b>
	<?php echo CHtml::encode($data->Content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Url')); ?>:</b>
	<?php echo CHtml::encode($data->Url); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('WapUrl')); ?>:</b>
	<?php echo CHtml::encode($data->WapUrl); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->UpdatedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserId')); ?>:</b>
	<?php echo CHtml::encode($data->UserId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Views')); ?>:</b>
	<?php echo CHtml::encode($data->Views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Useful')); ?>:</b>
	<?php echo CHtml::encode($data->Useful); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Unuseful')); ?>:</b>
	<?php echo CHtml::encode($data->Unuseful); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CateId')); ?>:</b>
	<?php echo CHtml::encode($data->CateId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SmallImage')); ?>:</b>
	<?php echo CHtml::encode($data->SmallImage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BigImage')); ?>:</b>
	<?php echo CHtml::encode($data->BigImage); ?>
	<br />

	*/ ?>

</div>