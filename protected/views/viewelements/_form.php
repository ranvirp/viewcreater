<?php
/* @var $this ViewelementsController */
/* @var $model Viewelements */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viewelements-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'siteid'); ?>
		<?php echo $form->textField($model,'siteid'); ?>
		<?php echo $form->error($model,'siteid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'html'); ?>
		<?php echo $form->textArea($model,'html',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'html'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'viewname'); ?>
		<?php echo $form->textArea($model,'viewname',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'viewname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elemid'); ?>
		<?php echo $form->textField($model,'elemid'); ?>
		<?php echo $form->error($model,'elemid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elemtype'); ?>
		<?php echo $form->textArea($model,'elemtype',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'elemtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elemparameters'); ?>
		<?php echo $form->textArea($model,'elemparameters',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'elemparameters'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elemcode'); ?>
		<?php echo $form->textArea($model,'elemcode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'elemcode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->