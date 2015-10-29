<?php
/* @var $this TicketMessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('database','Ticket Messages'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','TicketMessage'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','TicketMessage'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('database','Ticket Messages')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
