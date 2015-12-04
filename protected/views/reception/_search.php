<?php
/* @var $this ReceptionController */
/* @var $model Reception */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_reception'); ?>
		<?php echo $form->textField($model,'id_reception'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_headquarter'); ?>
		<?php echo $form->textField($model,'id_headquarter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recepction_date'); ?>
		<?php echo $form->textField($model,'recepction_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_embarkation'); ?>
		<?php echo $form->textField($model,'id_embarkation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->