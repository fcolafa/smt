<?php
/* @var $this WeightUnitController */
/* @var $model WeightUnit */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_weight_unit'); ?>
		<?php echo $form->textField($model,'id_weight_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight_unit_name'); ?>
		<?php echo $form->textField($model,'weight_unit_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->