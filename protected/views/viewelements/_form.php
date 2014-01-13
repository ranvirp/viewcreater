<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'viewelements-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'view_id'); ?>
		<?php echo $form->textField($model,'view_id'); ?>
		<?php echo $form->error($model,'view_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elem_id'); ?>
		<?php echo $form->textField($model,'elem_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'elem_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'html'); ?>
		<?php echo $form->textArea($model,'html',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'html'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->