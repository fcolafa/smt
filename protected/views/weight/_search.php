<?php
/* @var $this WeightController */
/* @var $model Weight */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_weight'); ?>
		<?php echo $form->textField($model,'id_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_provider'); ?>
		<?php echo $form->textField($model,'id_provider'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_weight_type'); ?>
		<?php echo $form->textField($model,'id_weight_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_weigth_unit'); ?>
		<?php echo $form->textField($model,'id_weigth_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount_weight'); ?>
		<?php echo $form->textField($model,'amount_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guide_id_guide'); ?>
		<?php echo $form->textField($model,'guide_id_guide'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->