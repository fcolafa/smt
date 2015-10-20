<?php
/* @var $this LaborController */
/* @var $model Labor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'labor-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_labor'); ?>
		<?php echo $form->textField($model,'id_labor',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'id_labor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_location'); ?>
		<?php echo $form->textField($model,'id_location'); ?>
		<?php echo $form->error($model,'id_location'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'date_labor'); ?>
		<?php echo $form->textField($model,'date_labor'); ?>
		<?php echo $form->error($model,'date_labor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_arrive'); ?>
		<?php echo $form->textField($model,'time_arrive'); ?>
		<?php echo $form->error($model,'time_arrive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_sailing'); ?>
		<?php echo $form->textField($model,'time_sailing'); ?>
		<?php echo $form->error($model,'time_sailing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'init_charge'); ?>
		<?php echo $form->textField($model,'init_charge'); ?>
		<?php echo $form->error($model,'init_charge'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_charge'); ?>
		<?php echo $form->textField($model,'end_charge'); ?>
		<?php echo $form->error($model,'end_charge'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'navigation_miles'); ?>
		<?php echo $form->textField($model,'navigation_miles'); ?>
		<?php echo $form->error($model,'navigation_miles'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'observations'); ?>
		<?php echo $form->textArea($model,'observations',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'observations'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->