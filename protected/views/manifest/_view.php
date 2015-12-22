<?php
/* @var $this ManifestController */
/* @var $data Manifest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_manifest')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_manifest), array('view', 'id'=>$data->id_manifest)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manifest_date')); ?>:</b>
	<?php echo CHtml::encode($data->manifest_date); ?>
	<br />


</div>