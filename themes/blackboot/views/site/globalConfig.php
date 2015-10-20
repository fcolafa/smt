<?php

$this->pageTitle=Yii::app()->name . ' -'.Yii::t('database','Global Configuration');
$this->breadcrumbs=array(
	'GlobalConfig',
);
?>

<h1><?php echo  Yii::t('database','Global Configuration')?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
        'enableAjaxValidation' => false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'adminEmail'); ?>
		<?php echo $form->textField($model,'adminEmail'); ?>
		<?php echo $form->error($model,'adminEmail'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'passwordEmail'); ?>
		<?php echo $form->passwordField($model,'passwordEmail',array('size'=>45,'maxlength'=>45,'minlength'=>6)); ?>
		<?php echo $form->error($model,'passwordEmail'); ?>
	</div>
          <div class="row">
		<?php echo $form->labelEx($model,'sessionTime'); ?>
		<?php echo $form->numberField($model,'sessionTime').'(minutos)'; ?>
		<?php echo $form->error($model,'sessionTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

