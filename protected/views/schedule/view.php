<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	Yii::t('database','Schedules')=>array('index'),
	$model->id_schedule,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Schedule'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Schedule'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Schedule'), 'url'=>array('update', 'id'=>$model->id_schedule)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Schedule'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_schedule),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Schedule'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Schedule')?> #<?php echo $model->id_schedule; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_schedule',
		'schedule_date',
		'initial_stock',
		'ranch_date',
		'ranch_diesel',
		'id_headquarter',
		'final_stock',
		'day_comsuption',
		'init_bb_motor',
		'finish_bb_motor',
		'init_eb_motor',
		'finish_eb_motor',
		'total_hours',
		'gen1_hours',
		'gen2_hours',
		'gen3_hours',
		'arrive_date',
		'horometer_bb',
		'horometer_eb',
		'horometer_gen1',
		'horometer_gen2',
		'horometer_gen3',
		'arrrive_stock',
		'total_water_charged',
		'earthing',
		'id_user',
		'notes',
	),
)); ?>
