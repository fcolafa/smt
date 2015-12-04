<?php
/* @var $this ReceptionController */
/* @var $model Reception */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reception-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_reception'); ?>
		<?php echo $form->textField($model,'id_reception'); ?>
		<?php echo $form->error($model,'id_reception'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_headquarter'); ?>
		<?php echo $form->textField($model,'id_headquarter'); ?>
		<?php echo $form->error($model,'id_headquarter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recepction_date'); ?>
		<?php echo $form->textField($model,'recepction_date'); ?>
		<?php echo $form->error($model,'recepction_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_embarkation'); ?>
		<?php echo $form->textField($model,'id_embarkation'); ?>
		<?php echo $form->error($model,'id_embarkation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->