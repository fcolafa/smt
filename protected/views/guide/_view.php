<?php
/* @var $this GuideController */
/* @var $data Guide */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_guide')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_guide), array('view', 'id'=>$data->id_guide)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('num_guide')); ?>:</b>
	<?php echo CHtml::encode($data->num_guide); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('pdf_guide')); ?>:</b>
	<?php echo CHtml::encode($data->pdf_guide); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_guide_create')); ?>:</b>
	<?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM y  HH:mm:ss",strtotime($data->date_guide_create))); ?>
	<br />
        
</div>