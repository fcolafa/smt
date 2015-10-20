<?php
/* @var $this EmbarkationController */
/* @var $data Embarkation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_embarkation')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_embarkation), array('view', 'id'=>$data->id_embarkation)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('embarkation_name')); ?>:</b>
	<?php echo CHtml::encode($data->embarkation_name); ?>
	<br />


</div>