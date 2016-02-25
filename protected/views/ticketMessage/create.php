<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */

$this->breadcrumbs=array(
	Yii::t('database','Ticket Messages')=>array('admin'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".Yii::t('database','TicketMessage'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','TicketMessage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','TicketMessage')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>