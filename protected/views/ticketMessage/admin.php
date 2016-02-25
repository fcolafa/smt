<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Ticket Messages'))=>array('admin'),
	Yii::t('actions','Manage'),
);

$this->menu=array(
array('label'=>Yii::t('actions','List')." ". Yii::t('database','TicketMessage'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','TicketMessage'), 'url'=>array('create')),
);?>
<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Ticket Messages')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ticket-message-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_ticket_message',
		'id_ticket',
		'ticket_message',
		'id_user',
		'ticket_order',
		'ticket_message_date',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
