<?php
/* @var $this HeadquarterController */
/* @var $data Headquarter */
?>

<div class="view">

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('headquarter_name')); ?>:</b>
	<?php echo CHtml::encode($data->headquarter_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headquarter_location')); ?>:</b>
	<?php echo CHtml::encode($data->headquarter_location); ?>
	<br />


</div>