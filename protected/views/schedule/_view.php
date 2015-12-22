<?php
/* @var $this ScheduleController */
/* @var $data Schedule */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_schedule')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_schedule), array('view', 'id'=>$data->id_schedule)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('schedule_date')); ?>:</b>
	<?php echo CHtml::encode($data->schedule_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('initial_stock')); ?>:</b>
	<?php echo CHtml::encode($data->initial_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ranch_date')); ?>:</b>
	<?php echo CHtml::encode($data->ranch_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ranch_diesel')); ?>:</b>
	<?php echo CHtml::encode($data->ranch_diesel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_headquarter')); ?>:</b>
	<?php echo CHtml::encode($data->id_headquarter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_stock')); ?>:</b>
	<?php echo CHtml::encode($data->final_stock); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('day_comsuption')); ?>:</b>
	<?php echo CHtml::encode($data->day_comsuption); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('init_bb_motor')); ?>:</b>
	<?php echo CHtml::encode($data->init_bb_motor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finish_bb_motor')); ?>:</b>
	<?php echo CHtml::encode($data->finish_bb_motor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('init_eb_motor')); ?>:</b>
	<?php echo CHtml::encode($data->init_eb_motor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finish_eb_motor')); ?>:</b>
	<?php echo CHtml::encode($data->finish_eb_motor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_hours')); ?>:</b>
	<?php echo CHtml::encode($data->total_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gen1_hours')); ?>:</b>
	<?php echo CHtml::encode($data->gen1_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gen2_hours')); ?>:</b>
	<?php echo CHtml::encode($data->gen2_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gen3_hours')); ?>:</b>
	<?php echo CHtml::encode($data->gen3_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arrive_date')); ?>:</b>
	<?php echo CHtml::encode($data->arrive_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horometer_bb')); ?>:</b>
	<?php echo CHtml::encode($data->horometer_bb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horometer_eb')); ?>:</b>
	<?php echo CHtml::encode($data->horometer_eb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horometer_gen1')); ?>:</b>
	<?php echo CHtml::encode($data->horometer_gen1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horometer_gen2')); ?>:</b>
	<?php echo CHtml::encode($data->horometer_gen2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horometer_gen3')); ?>:</b>
	<?php echo CHtml::encode($data->horometer_gen3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arrrive_stock')); ?>:</b>
	<?php echo CHtml::encode($data->arrrive_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_water_charged')); ?>:</b>
	<?php echo CHtml::encode($data->total_water_charged); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('earthing')); ?>:</b>
	<?php echo CHtml::encode($data->earthing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	*/ ?>

</div>