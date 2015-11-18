<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	Yii::t('database','Tickets')=>array('admin'),
	Yii::t('actions','Create'),
);
$this->menu=array(
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Ticket'), 'url'=>array('admin')),
);
?>
<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Ticket')?></h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>