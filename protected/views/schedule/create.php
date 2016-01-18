<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	Yii::t('database','Schedules')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ".Yii::t('database','Schedule'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Schedule'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Schedule')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>