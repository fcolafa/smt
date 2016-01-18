<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	Yii::t('database','Schedules')=>array('index'),
	$model->id_schedule=>array('view','id'=>$model->id_schedule),
	Yii::t('actions','Update'),
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Schedule'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Schedule'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Schedule'), 'url'=>array('view', 'id'=>$model->id_schedule)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Schedule'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Schedule')?> <?php echo $model->id_schedule; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>