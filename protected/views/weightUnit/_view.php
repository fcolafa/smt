<?php
/* @var $this WeightUnitController */
/* @var $data WeightUnit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_weight_unit')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_weight_unit), array('view', 'id'=>$data->id_weight_unit)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight_unit_name')); ?>:</b>
	<?php echo CHtml::encode($data->weight_unit_name); ?>
	<br />


</div>