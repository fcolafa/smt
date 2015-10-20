<?php
/* @var $this LaborController */
/* @var $model Labor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_labor'); ?>
		<?php echo $form->textField($model,'id_labor',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_location'); ?>
		<?php echo $form->textField($model,'id_location'); ?>
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
		<?php echo $form->label($model,'date_labor'); ?>
		<?php echo $form->textField($model,'date_labor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_arrive'); ?>
		<?php echo $form->textField($model,'time_arrive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_sailing'); ?>
		<?php echo $form->textField($model,'time_sailing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'init_charge'); ?>
		<?php echo $form->textField($model,'init_charge'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_charge'); ?>
		<?php echo $form->textField($model,'end_charge'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'navigation_miles'); ?>
		<?php echo $form->textField($model,'navigation_miles'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observations'); ?>
		<?php echo $form->textArea($model,'observations',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->