<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_ticket'); ?>
		<?php echo $form->textField($model,'id_ticket'); ?>
		<?php echo $form->error($model,'id_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ticket_message'); ?>
		<?php echo $form->textField($model,'ticket_message',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ticket_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ticket_order'); ?>
		<?php echo $form->textField($model,'ticket_order'); ?>
		<?php echo $form->error($model,'ticket_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ticket_message_date'); ?>
		<?php echo $form->textField($model,'ticket_message_date'); ?>
		<?php echo $form->error($model,'ticket_message_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->