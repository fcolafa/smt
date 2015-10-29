<?php
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/jquery.Rut.js');
?>

<script type="text/javascript">
    
$(document).ready(function(e) {    
$('#Users_user_rut').Rut({
  on_error: function(){ alert('Rut incorrecto'); },
  format_on: 'keyup'
});
  });
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>
        <?php
             if($model->first_time==0){ ?>
        <p class="note">Antes de poder realizar cualquier accion debe actualizar sus datos </p>
        <?php }?>
	<?php echo $form->errorSummary($model); ?>
       
	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
         <div class="row">
		<?php echo $form->labelEx($model,'_oldpassword'); ?>
		<?php echo $form->passwordField($model,'_oldpassword',array('size'=>45,'maxlength'=>45,'minlength'=>6)); ?>
		<?php echo $form->error($model,'_oldpassword'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>45,'maxlength'=>45,'minlength'=>6)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
        <div class="row">  
             <?php echo $form->label($model,'password_repeat'); ?>    
             <?php echo $form->passwordField($model,'password_repeat',array('size'=>45,'maxlength'=>45,'minlength'=>6)); ?>    
             <?php echo $form->error($model,'password_repeat'); ?> 
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'user_names'); ?>
		<?php echo $form->textField($model,'user_names',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'user_names'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'user_lastnames'); ?>
		<?php echo $form->textField($model,'user_lastnames',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'user_lastnames'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'user_rut'); ?>
		<?php echo $form->textField($model,'user_rut',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'user_rut'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'user_phone'); ?>
		<?php echo $form->textField($model,'user_phone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'user_phone'); ?>
	</div>
       
   
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->