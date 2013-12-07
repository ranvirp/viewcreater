<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_id')); ?>:</b>
	<?php echo CHtml::encode($data->view_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('elem_id')); ?>:</b>
	<?php echo CHtml::encode($data->elem_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('html')); ?>:</b>
	<?php echo CHtml::encode($data->html); ?>
	<br />


</div>