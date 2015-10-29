<?php
/* @var $this TicketController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('database','Tickets'),
);


$this->menu=array(
        array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Ticket'), 'url'=>array('create'),'visible'=>  Yii::app()->user->checkAccess('Cliente')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Tickets'), 'url'=>array('admin') ),
	
);
?>

<h1> <?php echo Yii::t('database','Tickets')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
