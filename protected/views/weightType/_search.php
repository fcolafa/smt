<?php
/* @var $this WeightTypeController */
/* @var $model WeightType */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_weight_type'); ?>
		<?php echo $form->textField($model,'id_weight_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight_type_name'); ?>
		<?php echo $form->textField($model,'weight_type_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->