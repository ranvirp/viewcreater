<?php
/* @var $this ViewelementsController */
/* @var $model Viewelements */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'siteid'); ?>
		<?php echo $form->textField($model,'siteid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'html'); ?>
		<?php echo $form->textArea($model,'html',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'viewname'); ?>
		<?php echo $form->textArea($model,'viewname',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elemid'); ?>
		<?php echo $form->textField($model,'elemid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elemtype'); ?>
		<?php echo $form->textArea($model,'elemtype',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elemparameters'); ?>
		<?php echo $form->textArea($model,'elemparameters',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elemcode'); ?>
		<?php echo $form->textArea($model,'elemcode',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->