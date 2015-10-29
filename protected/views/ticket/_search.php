<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_ticket'); ?>
		<?php echo $form->textField($model,'id_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_embarkation'); ?>
		<?php echo $form->textField($model,'id_embarkation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->label($model,'date_ticket'); ?>
		<?php echo $form->textField($model,'date_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_ticket'); ?>
		<?php echo $form->textArea($model,'description_ticket',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ticket_status'); ?>
		<?php echo $form->textField($model,'ticket_status',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->