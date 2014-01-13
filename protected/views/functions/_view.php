<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('controller')); ?>:</b>
	<?php echo CHtml::encode($data->controller); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order')); ?>:</b>
	<?php echo CHtml::encode($data->order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parameters')); ?>:</b>
	<?php echo CHtml::encode($data->parameters); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entry_time')); ?>:</b>
	<?php echo CHtml::encode($data->entry_time); ?>
	<br />

	*/ ?>

</div>