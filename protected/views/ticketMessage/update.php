<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */

$this->breadcrumbs=array(
	Yii::t('database','Ticket Messages')=>array('admin'),
	$model->id_ticket_message=>array('view','id'=>$model->id_ticket_message),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','TicketMessage'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','TicketMessage'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','TicketMessage'), 'url'=>array('view', 'id'=>$model->id_ticket_message)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','TicketMessage'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','TicketMessage')?> <?php echo $model->id_ticket_message; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>