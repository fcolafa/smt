<?php
/* @var $this BridgeController */
/* @var $model Bridge */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_bridge'); ?>
		<?php echo $form->textField($model,'id_bridge',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_headquarter'); ?>
		<?php echo $form->textField($model,'id_headquarter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bridge_date_arrive'); ?>
		<?php echo $form->textField($model,'bridge_date_arrive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'init_charge_time'); ?>
		<?php echo $form->textField($model,'init_charge_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finish_charge_time'); ?>
		<?php echo $form->textField($model,'finish_charge_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bridge_date_sailing'); ?>
		<?php echo $form->textField($model,'bridge_date_sailing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bridge_notes'); ?>
		<?php echo $form->textArea($model,'bridge_notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bridge_date'); ?>
		<?php echo $form->textField($model,'bridge_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->