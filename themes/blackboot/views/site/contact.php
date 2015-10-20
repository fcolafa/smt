<?php
$this->pageTitle=Yii::app()->name . '- '. yii::t('database','Providers');
$this->breadcrumbs=array(
	Yii::t('actions','Contact'),
);
?>

<h1><?php echo Yii::t('database', 'Providers') ?></h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

        <p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
            
                <?php
                if(isset($provider))
                echo $form->dropDownList($model,'email',$provider,array('prompt'=>Yii::t('actions','Select')." ".Yii::t('database','Provider')));
                else
                echo $form->dropDownList($model,'email',CHtml::listData(Provider::model()->findAll(),'id_provider','provider_name'),array('prompt'=>Yii::t('actions','Select')." ".Yii::t('database','Provider'))); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>10, 'cols'=>60)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
        <br />
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint"> <?php echo Yii::t('validation','Please enter the letters as they are shown in the image above')?>.
		<br/><?php echo Yii::t('validation','Letters are not case-sensitive.')?></div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Send'),array('class'=>'button grey')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; 