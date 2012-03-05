<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
	<?php echo CHtml::encode($data->Title); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('CateId')); ?>:</b>
	<?php echo CHtml::encode($data->CateId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ImageThumbScale')); ?>:</b>
	<?php echo CHtml::encode($data->ImageThumbScale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CoverImage')); ?>:</b>
	<?php echo CHtml::encode($data->CoverImage); ?>
	<br />


</div>