<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	//'id'=>'event-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	//'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event start date/time'); ?>
		<?php echo $form->numberField($model,'event_time'); ?>
		<?php echo $form->error($model,'event_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event end date/time'); ?>
		<?php echo $form->numberField($model,'details[event_end]'); ?>
		<?php echo $form->error($model,'details[event_end]'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lattitude'); ?>
		<?php echo $form->textField($model,'details[latitude]'); ?>
		<?php echo $form->error($model,'details[latitude]'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longtitude'); ?>
		<?php echo $form->textField($model,'details[longtitude]'); ?>
		<?php echo $form->error($model,'details[longtitude]'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'participation cost'); ?>
		<?php echo $form->numberField($model,'details[cost]'); ?> <span class="currency">UAH</span>
		<?php echo $form->error($model,'details[cost]'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->