<?php
/* @var $this TicketController */
/* @var $data Ticket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ticket')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_ticket), array('view', 'id'=>$data->id_ticket)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('idEmbarkation.embarkation_name')); ?>:</b>
	<?php echo CHtml::encode($data->idEmbarkation->embarkation_name); ?>
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('Usuario')); ?>:</b>
	<?php echo CHtml::encode($data->idUser->user_name); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('Nombre de pila')); ?>:</b>
	<?php echo CHtml::encode($data->idUser->user_names." ".$data->idUser->user_lastnames); ?>
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('Empresa')); ?>:</b>
	<?php echo CHtml::encode($data->idUser->idCompany->company_name); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_date')); ?>:</b>
	<?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM y  HH:mm:ss",strtotime($data->ticket_date))); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_status')); ?>:</b>
	<?php echo CHtml::encode($data->ticket_status); ?>
	<br />


</div>