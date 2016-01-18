<?php
/* @var $this HeadquarterController */
/* @var $model Headquarter */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_headquarter'); ?>
		<?php echo $form->textField($model,'id_headquarter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_area'); ?>
		<?php echo $form->textField($model,'id_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'headquarter_name'); ?>
		<?php echo $form->textField($model,'headquarter_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'headquarter_location'); ?>
		<?php echo $form->textField($model,'headquarter_location',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'headquarter_type'); ?>
		<?php echo $form->textField($model,'headquarter_type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_company'); ?>
		<?php echo $form->textField($model,'id_company'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->