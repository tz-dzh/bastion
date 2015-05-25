<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php /**
	 * if user is logged in we fill the name and email with his data
	 * @todo: if user is logged in save his id in db instead of name/mail
	 */
	if (Yii::app()->user->isGuest)
	{ ?>
		<div class="row">
			<?php echo $form->labelEx($model,'author'); ?>
			<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'author'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
	<?php }
	else
	{
		echo $form->hiddenField($model,'author',array('size'=>60,'maxlength'=>128,'value'=>Yii::app()->user->name));
		echo $form->hiddenField($model,'email',array('size'=>60,'maxlength'=>128,'value'=>Yii::app()->user->getState('email')));
	} ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->