<?php
/* @var $this BridgeController */
/* @var $model Bridge */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bridge-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>



	  <div class="row"> 
         <?php echo $form->labelEx($model,'id_headquarter'); ?>
         <?php echo $form->dropDownList($model,'id_headquarter',CHtml::listData(Headquarter::model()->findAll(array('order'=>'headquarter_name')),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Ubicación asociada'));?>
         <?php 
           
//             if ($model->id_headquarter&& $model->id_headquarter!=0)
//             {
//                 $value=$model->idHeadquarter->headquarter_name;
//             }
//             else {
//                 $value='';
//             }
//             echo $form->hiddenField($model, 'id_headquarter' ,array());
//             $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
//             'name'=>'headquarter_name',
//             'model'=>$model,
//             'value'=>$value,
//             'sourceUrl'=>$this->createUrl('listHeadquarter'),
//             'options'=>array(
//             'minLength'=>'1',
//             'showAnim'=>'fold',
//             'select' => 'js:function(event, ui)
//             { jQuery("#Ticket_id_headquarter").val(ui.item["id"]); }',
//             'search'=> 'js:function(event, ui)
//             { jQuery("#Ticket_id_headquarter").val(0); }'
//             ),
//             ));
         ?>
            <?php echo $form->error($model,'id_headquarter'); ?>
	</div>

	
        <div class="row">
		<?php echo $form->labelEx($model,'id_embarkation'); ?>
		<?php echo $form->dropDownList($model,'id_embarkation',  CHtml::listData(Embarkation::model()->findAll(array('order'=>'embarkation_name')), 'id_embarkation', 'embarkation_name'),array('prompt'=>'Seleccione nave asociada','prompt'=>'Ninguna nave asociada')); ?>
		<?php echo $form->error($model,'id_embarkation'); ?>
	</div>
        
         <div class="row">
		   <?php echo $form->labelEx($model,'bridge_date_arrive'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'bridge_date_arrive', //attribute name
               'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'dd-mm-yy',
            'maxDate' => 'today',
        ), // jquery plugin options
    ));
        
?>
     <?php echo $form->error($model,'bridge_date_arrive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'init_charge_time'); ?>
		<?php echo $form->timeField($model,'init_charge_time'); ?>
		<?php echo $form->error($model,'init_charge_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finish_charge_time'); ?>
		<?php echo $form->timeField($model,'finish_charge_time'); ?>
		<?php echo $form->error($model,'finish_charge_time'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'navigated_miles'); ?>
		<?php echo $form->numberField($model,'navigated_miles',array('step'=>0.1,'min'=>0)); ?>
		<?php echo $form->error($model,'navigated_miles'); ?>
	</div>

	
            <div class="row">
		   <?php echo $form->labelEx($model,'bridge_date_sailing'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'bridge_date_sailing', //attribute name
               'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'dd-mm-yy',
            'maxDate' => 'today',
        ), // jquery plugin options
    ));
        
?>
     <?php echo $form->error($model,'bridge_date_sailing'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'bridge_notes'); ?>
		<?php echo $form->textArea($model,'bridge_notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'bridge_notes'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->