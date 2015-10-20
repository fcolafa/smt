<?php
/* @var $this LaborController */
/* @var $data Labor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_labor')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_labor), array('view', 'id'=>$data->id_labor)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_location')); ?>:</b>
	<?php echo CHtml::encode($data->id_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_embarkation')); ?>:</b>
	<?php echo CHtml::encode($data->id_embarkation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_labor')); ?>:</b>
	<?php echo CHtml::encode($data->date_labor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_arrive')); ?>:</b>
	<?php echo CHtml::encode($data->time_arrive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_sailing')); ?>:</b>
	<?php echo CHtml::encode($data->time_sailing); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('init_charge')); ?>:</b>
	<?php echo CHtml::encode($data->init_charge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_charge')); ?>:</b>
	<?php echo CHtml::encode($data->end_charge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('navigation_miles')); ?>:</b>
	<?php echo CHtml::encode($data->navigation_miles); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observations')); ?>:</b>
	<?php echo CHtml::encode($data->observations); ?>
	<br />

	*/ ?>

</div>