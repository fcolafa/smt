<?php
/* @var $this WeightTypeController */
/* @var $data WeightType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_weight_type')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_weight_type), array('view', 'id'=>$data->id_weight_type)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight_type_name')); ?>:</b>
	<?php echo CHtml::encode($data->weight_type_name); ?>
	<br />


</div>