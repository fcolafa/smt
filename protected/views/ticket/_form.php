<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_embarkation'); ?>
		<?php echo $form->dropDownList($model,'id_embarkation',  CHtml::listData(Embarkation::model()->findAll(), 'id_embarkation', 'embarkation_name'),array('prompt'=>'Seleccione Nave Asociada')); ?>
		<?php echo $form->error($model,'id_embarkation'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'id_headquarter'); ?>
		<?php echo $form->dropDownList($model,'id_headquarter',  CHtml::listData(Headquarter::model()->findAll(), 'id_headquarter', 'headquarter_name'),array('prompt'=>'Seleccione Centro Asociado')); ?>
		<?php echo $form->error($model,'id_headquarter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ticket_description'); ?>
		<?php echo $form->textArea($model,'ticket_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ticket_description'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'ticket_file'); ?>
		<?php echo CHtml::activeFileField($model,'ticket_file'); ?>
		<?php echo $form->error($model,'ticket_file'); ?>
	</div>
        <div class="row">
		   <?php echo $form->labelEx($model,'ticket_date_incident'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'ticket_date_incident', //attribute name
               'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'dd-mm-yy',
            'maxDate' => 'today',
        ), // jquery plugin options
    ));
        
?>
     <?php echo $form->error($model,'ticket_date_incident'); ?>
	</div>
        
         <div class="row">
            <label></label>
            <?php $this->widget('CCaptcha'); ?>
        </div>

        <div class="row">
                <?php echo $form->labelEx($model,'_verifyCode'); ?>
               <?php echo $form->textField($model,'_verifyCode'); ?>
               <?php echo $form->error($model,'_verifyCode'); ?>
        </div>
      
	
    
		
	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->