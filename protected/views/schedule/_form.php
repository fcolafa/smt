<?php
/* @var $this ScheduleController */
/* @var $model Schedule */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'schedule-form',
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
         <?php echo $form->error($model,'id_headquarter'); ?>
         </div>
    
	<div class="row">	<?php echo $form->labelEx($model,'id_embarkation'); ?>
		<?php echo $form->dropDownList($model,'id_embarkation',  CHtml::listData(Embarkation::model()->findAll(array('order'=>'embarkation_name')), 'id_embarkation', 'embarkation_name'),array('prompt'=>'Seleccione nave asociada','prompt'=>'Ninguna nave asociada')); ?>
		<?php echo $form->error($model,'id_embarkation'); ?>
        </div>
	<div class="row">
		<?php echo $form->labelEx($model,'initial_stock'); ?>
		<?php echo $form->numberField($model,'initial_stock', array('step'=>0.1)); ?>
		<?php echo $form->error($model,'initial_stock'); ?>
	</div>
    
         <div class="row">
		   <?php echo $form->labelEx($model,'ranch_date'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'ranch_date', //attribute name
               'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'dd-mm-yy',
            'maxDate' => 'today',
        ), // jquery plugin options
    ));
        
?>
     <?php echo $form->error($model,'ranch_date'); ?>
	</div>
 
	<div class="row">
		<?php echo $form->labelEx($model,'ranch_diesel'); ?>
		<?php echo $form->numberField($model,'ranch_diesel', array('step'=>0.1)); ?>
		<?php echo $form->error($model,'ranch_diesel'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'delivery_DO'); ?>
		<?php echo $form->numberField($model,'delivery_DO', array('step'=>0.1)); ?>
		<?php echo $form->error($model,'delivery_DO'); ?>
	</div>
<
	<div class="row">
		<?php echo $form->labelEx($model,'final_stock'); ?>
		<?php echo $form->numberField($model,'final_stock',array('step'=>0.1)); ?>
		<?php echo $form->error($model,'final_stock'); ?>
	</div>
            
       <fieldset>
           <legend> Horometro Motor Babor</legend>
            <div class="col-md-3">
                    <?php echo $form->labelEx($model,'init_bb_motor'); ?>
                    <?php echo $form->textField($model,'init_bb_motor'); ?>
                    <?php echo $form->error($model,'init_bb_motor'); ?>
            </div>

            <div class="col-md-3">
                    <?php echo $form->labelEx($model,'finish_bb_motor'); ?>
                    <?php echo $form->textField($model,'finish_bb_motor'); ?>
                    <?php echo $form->error($model,'finish_bb_motor'); ?>
            </div>
          
       </fieldset>
            
       <fieldset>
           <legend>Horometro Motor Estribor</legend>
              <div class="col-md-3">
                      <?php echo $form->labelEx($model,'init_eb_motor'); ?>
                      <?php echo $form->textField($model,'init_eb_motor'); ?>
                      <?php echo $form->error($model,'init_eb_motor'); ?>
              </div>

              <div class="col-md-3">
                      <?php echo $form->labelEx($model,'finish_eb_motor'); ?>
                      <?php echo $form->textField($model,'finish_eb_motor'); ?>
                      <?php echo $form->error($model,'finish_eb_motor'); ?>
              </div>
       </fieldset>
           
        <fieldset>
            <legend>Horas de servicio en el día</legend>
	<div class="row">
		<?php echo $form->labelEx($model,'gen1_hours'); ?>
		<?php echo $form->textField($model,'gen1_hours'); ?>
		<?php echo $form->error($model,'gen1_hours'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'gen2_hours'); ?>
		<?php echo $form->textField($model,'gen2_hours'); ?>
		<?php echo $form->error($model,'gen2_hours'); ?>
	</div>
          
	<div class="row">
		<?php echo $form->labelEx($model,'gen3_hours'); ?>
		<?php echo $form->textField($model,'gen3_hours'); ?>
		<?php echo $form->error($model,'gen3_hours'); ?>
	</div>       
        </fieldset>
               
        <fieldset>
            <legend>Datos Recalada</legend>
	
                <div class="row">
		   <?php echo $form->labelEx($model,'arrive_date'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'arrive_date', //attribute name
               'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'dd-mm-yy',
            'maxDate' => 'today',
        ), // jquery plugin options
    ));
        
?>
     <?php echo $form->error($model,'arrive_date'); ?>
	</div>
     
	<div class="row">
		<?php echo $form->labelEx($model,'horometer_bb'); ?>
		<?php echo $form->textField($model,'horometer_bb'); ?>
		<?php echo $form->error($model,'horometer_bb'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'horometer_eb'); ?>
		<?php echo $form->textField($model,'horometer_eb'); ?>
		<?php echo $form->error($model,'horometer_eb'); ?>
	</div>
 
	<div class="row">
		<?php echo $form->labelEx($model,'horometer_gen1'); ?>
		<?php echo $form->textField($model,'horometer_gen1'); ?>
		<?php echo $form->error($model,'horometer_gen1'); ?>
	</div>
     
	<div class="row">
		<?php echo $form->labelEx($model,'horometer_gen2'); ?>
		<?php echo $form->textField($model,'horometer_gen2'); ?>
		<?php echo $form->error($model,'horometer_gen2'); ?>
	</div>
      
	<div class="row">
		<?php echo $form->labelEx($model,'horometer_gen3'); ?>
		<?php echo $form->textField($model,'horometer_gen3'); ?>
		<?php echo $form->error($model,'horometer_gen3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'arrive_stock'); ?>
		<?php echo $form->textField($model,'arrive_stock'); ?>
		<?php echo $form->error($model,'arrive_stock'); ?>
	</div>
    
        </fieldset>
                          
	<div class="row">
		<?php echo $form->labelEx($model,'total_water_charged'); ?>
		<?php echo $form->textField($model,'total_water_charged'); ?>
		<?php echo $form->error($model,'total_water_charged'); ?>
	</div>
                                        
	<div class="row">
		<?php echo $form->labelEx($model,'earthing'); ?>
		<?php echo $form->textField($model,'earthing'); ?>
		<?php echo $form->error($model,'earthing'); ?>
	</div>
                </td>

    	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>
            
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>
                        
     </div>

<?php $this->endWidget(); ?>

</div><!-- form -->