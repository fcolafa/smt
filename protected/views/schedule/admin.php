<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Schedules'))=>array('index'),
	Yii::t('actions','Manage'),
);

$this->menu=array(
array('label'=>Yii::t('actions','List')." ". Yii::t('database','Schedule'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Schedule'), 'url'=>array('create')),
);?>
<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Schedules')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'schedule-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_schedule',
		'schedule_date',
		'initial_stock',
		'ranch_date',
		'ranch_diesel',
		'id_headquarter',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
