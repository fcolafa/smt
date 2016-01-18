<?php
/* @var $this BridgeController */
/* @var $data Bridge */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_bridge')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_bridge), array('view', 'ids'=>$data->id_bridge)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_headquarter')); ?>:</b>
	<?php echo CHtml::encode($data->id_headquarter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bridge_date_arrive')); ?>:</b>
	<?php echo CHtml::encode($data->bridge_date_arrive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('init_charge_time')); ?>:</b>
	<?php echo CHtml::encode($data->init_charge_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finish_charge_time')); ?>:</b>
	<?php echo CHtml::encode($data->finish_charge_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bridge_date_sailing')); ?>:</b>
	<?php echo CHtml::encode($data->bridge_date_sailing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bridge_notes')); ?>:</b>
	<?php echo CHtml::encode($data->bridge_notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bridge_date')); ?>:</b>
	<?php echo CHtml::encode($data->bridge_date); ?>
	<br />

	*/ ?>

</div>