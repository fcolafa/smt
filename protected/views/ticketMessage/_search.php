<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_ticket_message'); ?>
		<?php echo $form->textField($model,'id_ticket_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_ticket'); ?>
		<?php echo $form->textField($model,'id_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ticket_message'); ?>
		<?php echo $form->textField($model,'ticket_message',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ticket_order'); ?>
		<?php echo $form->textField($model,'ticket_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ticket_message_date'); ?>
		<?php echo $form->textField($model,'ticket_message_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->