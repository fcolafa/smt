<?php
/* @var $this WeightController */
/* @var $model Weight */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'weight-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_weight'); ?>
		<?php echo $form->textField($model,'id_weight'); ?>
		<?php echo $form->error($model,'id_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_provider'); ?>
		<?php echo $form->textField($model,'id_provider'); ?>
		<?php echo $form->error($model,'id_provider'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_weight_type'); ?>
		<?php echo $form->textField($model,'id_weight_type'); ?>
		<?php echo $form->error($model,'id_weight_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_weigth_unit'); ?>
		<?php echo $form->textField($model,'id_weigth_unit'); ?>
		<?php echo $form->error($model,'id_weigth_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount_weight'); ?>
		<?php echo $form->textField($model,'amount_weight'); ?>
		<?php echo $form->error($model,'amount_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide_id_guide'); ?>
		<?php echo $form->textField($model,'guide_id_guide'); ?>
		<?php echo $form->error($model,'guide_id_guide'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->