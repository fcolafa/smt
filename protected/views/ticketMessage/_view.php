<?php
/* @var $this TicketMessageController */
/* @var $data TicketMessage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ticket_message')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_ticket_message), array('view', 'id'=>$data->id_ticket_message)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ticket')); ?>:</b>
	<?php echo CHtml::encode($data->id_ticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_message')); ?>:</b>
	<?php echo CHtml::encode($data->ticket_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_order')); ?>:</b>
	<?php echo CHtml::encode($data->ticket_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_message_date')); ?>:</b>
	<?php echo CHtml::encode($data->ticket_message_date); ?>
	<br />


</div>