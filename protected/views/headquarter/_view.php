<?php
/* @var $this HeadquarterController */
/* @var $data Headquarter */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_headquarter')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_headquarter), array('view', 'id'=>$data->id_headquarter)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_area')); ?>:</b>
	<?php echo CHtml::encode($data->id_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headquarter_name')); ?>:</b>
	<?php echo CHtml::encode($data->headquarter_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headquarter_location')); ?>:</b>
	<?php echo CHtml::encode($data->headquarter_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headquarter_type')); ?>:</b>
	<?php echo CHtml::encode($data->headquarter_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_company')); ?>:</b>
	<?php echo CHtml::encode($data->id_company); ?>
	<br />


</div>