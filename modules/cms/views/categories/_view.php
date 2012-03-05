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

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Image')); ?>:</b>
	<?php echo CHtml::encode($data->Image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ParentId')); ?>:</b>
	<?php echo CHtml::encode($data->ParentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsActive')); ?>:</b>
	<?php echo CHtml::encode($data->IsActive); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Ordering')); ?>:</b>
	<?php echo CHtml::encode($data->Ordering); ?>
	<br />

	*/ ?>

</div>