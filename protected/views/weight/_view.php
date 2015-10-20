<?php
/* @var $this WeightController */
/* @var $data Weight */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_weight')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_weight), array('view', 'id'=>$data->id_weight)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_provider')); ?>:</b>
	<?php echo CHtml::encode($data->id_provider); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_weight_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_weight_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_weigth_unit')); ?>:</b>
	<?php echo CHtml::encode($data->id_weigth_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount_weight')); ?>:</b>
	<?php echo CHtml::encode($data->amount_weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide_id_guide')); ?>:</b>
	<?php echo CHtml::encode($data->guide_id_guide); ?>
	<br />


</div>