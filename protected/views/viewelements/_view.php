<?php
/* @var $this ViewelementsController */
/* @var $data Viewelements */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('siteid')); ?>:</b>
	<?php echo CHtml::encode($data->siteid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('html')); ?>:</b>
	<?php echo CHtml::encode($data->html); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viewname')); ?>:</b>
	<?php echo CHtml::encode($data->viewname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('elemid')); ?>:</b>
	<?php echo CHtml::encode($data->elemid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('elemtype')); ?>:</b>
	<?php echo CHtml::encode($data->elemtype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('elemparameters')); ?>:</b>
	<?php echo CHtml::encode($data->elemparameters); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('elemcode')); ?>:</b>
	<?php echo CHtml::encode($data->elemcode); ?>
	<br />

	*/ ?>

</div>