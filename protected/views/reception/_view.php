<?php
/* @var $this ReceptionController */
/* @var $data Reception */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_reception')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_reception), array('view', 'id'=>$data->id_reception)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_headquarter')); ?>:</b>
	<?php echo CHtml::encode($data->id_headquarter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recepction_date')); ?>:</b>
	<?php echo CHtml::encode($data->recepction_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_embarkation')); ?>:</b>
	<?php echo CHtml::encode($data->id_embarkation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />


</div>