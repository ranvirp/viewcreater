<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ident')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ident), array('view', 'id'=>$data->ident)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
	<?php echo CHtml::encode($data->path); ?>
	<br />


</div>