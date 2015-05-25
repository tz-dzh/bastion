<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'application-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php /**
	 * if user is logged in we fill the name and email with his data
	 * @todo: if user is logged in save his id in db instead of name/mail
	 */ ?>
	<!--<div class="row">
		<?php echo $form->hiddenField($model,'author_id',array('size'=>60,'maxlength'=>128,'value'=>Yii::app()->user->id)); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'rate'); ?>
		<?php echo $form->numberField($model,'rate',array('min'=>1,'max'=>5,'step'=>1)); ?>
		<?php echo $form->error($model,'rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'I will participate!'); ?>
		<?php echo $form->checkBox($model,'accepted',array('value'=>1,)); ?>
		<?php echo $form->error($model,'accepted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->