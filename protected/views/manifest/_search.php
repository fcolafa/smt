<?php
/* @var $this ManifestController */
/* @var $model Manifest */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_manifest'); ?>
		<?php echo $form->textField($model,'id_manifest'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'manifest_date'); ?>
		<?php echo $form->textField($model,'manifest_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->