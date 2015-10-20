<?php
/* @var $this LaborController */
/* @var $model Labor */

$this->breadcrumbs=array(
	Yii::t('database','Labors')=>array('index'),
	$model->id_labor,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Labor'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Labor'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Labor'), 'url'=>array('update', 'id'=>$model->id_labor)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Labor'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_labor),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Labor'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Labor')?> #<?php echo $model->id_labor; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_labor',
		'id_location',
		'id_embarkation',
		'id_user',
		'date_labor',
		'time_arrive',
		'time_sailing',
		'init_charge',
		'end_charge',
		'navigation_miles',
		'observations',
	),
)); ?>
