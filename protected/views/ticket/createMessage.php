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
     

   $link="No Conformidad nº: ". CHtml::link(CHtml::encode($ticketm->id_ticket), Yii::app()->baseUrl . '/ticket/'.$ticketm->id_ticket, array('target'=>'_blank'));
    

?>
<h1><?php echo Yii::t('actions','Responder')?> <?php echo $link?></h1>
<?php $this->renderPartial('_form_message', array('ticketm'=>$ticketm)); ?>