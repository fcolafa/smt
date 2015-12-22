<?php
/* @var $this ScheduleController */
/* @var $model Schedule */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_schedule'); ?>
		<?php echo $form->textField($model,'id_schedule'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'schedule_date'); ?>
		<?php echo $form->textField($model,'schedule_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'initial_stock'); ?>
		<?php echo $form->textField($model,'initial_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ranch_date'); ?>
		<?php echo $form->textField($model,'ranch_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ranch_diesel'); ?>
		<?php echo $form->textField($model,'ranch_diesel'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_headquarter'); ?>
		<?php echo $form->textField($model,'id_headquarter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_stock'); ?>
		<?php echo $form->textField($model,'final_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'day_comsuption'); ?>
		<?php echo $form->textField($model,'day_comsuption'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'init_bb_motor'); ?>
		<?php echo $form->textField($model,'init_bb_motor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finish_bb_motor'); ?>
		<?php echo $form->textField($model,'finish_bb_motor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'init_eb_motor'); ?>
		<?php echo $form->textField($model,'init_eb_motor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finish_eb_motor'); ?>
		<?php echo $form->textField($model,'finish_eb_motor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_hours'); ?>
		<?php echo $form->textField($model,'total_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gen1_hours'); ?>
		<?php echo $form->textField($model,'gen1_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gen2_hours'); ?>
		<?php echo $form->textField($model,'gen2_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gen3_hours'); ?>
		<?php echo $form->textField($model,'gen3_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'arrive_date'); ?>
		<?php echo $form->textField($model,'arrive_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horometer_bb'); ?>
		<?php echo $form->textField($model,'horometer_bb'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horometer_eb'); ?>
		<?php echo $form->textField($model,'horometer_eb'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horometer_gen1'); ?>
		<?php echo $form->textField($model,'horometer_gen1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horometer_gen2'); ?>
		<?php echo $form->textField($model,'horometer_gen2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'horometer_gen3'); ?>
		<?php echo $form->textField($model,'horometer_gen3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'arrrive_stock'); ?>
		<?php echo $form->textField($model,'arrrive_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_water_charged'); ?>
		<?php echo $form->textField($model,'total_water_charged'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'earthing'); ?>
		<?php echo $form->textField($model,'earthing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('actions','Search'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->