<?php
/* @var $this HeadquarterController */
/* @var $model Headquarter */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'headquarter-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'headquarter_name'); ?>
		<?php echo $form->textField($model,'headquarter_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'headquarter_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'headquarter_location'); ?>
		<?php echo $form->textField($model,'headquarter_location',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'headquarter_location'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->