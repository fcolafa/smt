<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */

$this->breadcrumbs=array(
	Yii::t('database','Ticket Messages')=>array('admin'),
	$model->id_ticket_message,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','TicketMessage'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','TicketMessage'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','TicketMessage'), 'url'=>array('update', 'id'=>$model->id_ticket_message)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','TicketMessage'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_ticket_message),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','TicketMessage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','TicketMessage')?> #<?php echo $model->id_ticket_message; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_ticket_message',
		'id_ticket',
		'ticket_message',
		'id_user',
		'ticket_order',
		'ticket_message_date',
	),
)); ?>
