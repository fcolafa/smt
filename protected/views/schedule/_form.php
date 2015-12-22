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
		<?php echo $form->labelEx($model,'initial_stock'); ?>
		<?php echo $form->textField($model,'initial_stock'); ?>
		<?php echo $form->error($model,'initial_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ranch_date'); ?>
		<?php echo $form->textField($model,'ranch_date'); ?>
		<?php echo $form->error($model,'ranch_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ranch_diesel'); ?>
		<?php echo $form->textField($model,'ranch_diesel'); ?>
		<?php echo $form->error($model,'ranch_diesel'); ?>
	</div>

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
		<?php echo $form->labelEx($model,'final_stock'); ?>
		<?php echo $form->textField($model,'final_stock'); ?>
		<?php echo $form->error($model,'final_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day_comsuption'); ?>
		<?php echo $form->textField($model,'day_comsuption'); ?>
		<?php echo $form->error($model,'day_comsuption'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'init_bb_motor'); ?>
		<?php echo $form->textField($model,'init_bb_motor'); ?>
		<?php echo $form->error($model,'init_bb_motor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finish_bb_motor'); ?>
		<?php echo $form->textField($model,'finish_bb_motor'); ?>
		<?php echo $form->error($model,'finish_bb_motor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'init_eb_motor'); ?>
		<?php echo $form->textField($model,'init_eb_motor'); ?>
		<?php echo $form->error($model,'init_eb_motor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finish_eb_motor'); ?>
		<?php echo $form->textField($model,'finish_eb_motor'); ?>
		<?php echo $form->error($model,'finish_eb_motor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_hours'); ?>
		<?php echo $form->textField($model,'total_hours'); ?>
		<?php echo $form->error($model,'total_hours'); ?>
	</div>

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

	<div class="row">
		<?php echo $form->labelEx($model,'arrive_date'); ?>
		<?php echo $form->textField($model,'arrive_date'); ?>
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
		<?php echo $form->labelEx($model,'arrrive_stock'); ?>
		<?php echo $form->textField($model,'arrrive_stock'); ?>
		<?php echo $form->error($model,'arrrive_stock'); ?>
	</div>

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

	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->