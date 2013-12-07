<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cssframeworkname')); ?>:</b>
	<?php echo CHtml::encode($data->cssframeworkname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('htmltype')); ?>:</b>
	<?php echo CHtml::encode($data->htmltype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parameters')); ?>:</b>
	<?php echo CHtml::encode($data->parameters); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dummycode')); ?>:</b>
	<?php echo CHtml::encode($data->dummycode); ?>
	<br />


</div>