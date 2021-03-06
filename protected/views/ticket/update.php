<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	Yii::t('database','Tickets')=>array('admin'),
	$model->id_ticket=>array('view','id'=>$model->id_ticket),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Ticket'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Ticket'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Ticket'), 'url'=>array('view', 'id'=>$model->id_ticket)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Ticket'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Ticket')?> <?php echo $model->id_ticket; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>