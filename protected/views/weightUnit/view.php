<?php
/* @var $this WeightUnitController */
/* @var $model WeightUnit */

$this->breadcrumbs=array(
	Yii::t('database','Weight Units')=>array('admin'),
	$model->id_weight_unit,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','WeightUnit'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','WeightUnit'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','WeightUnit'), 'url'=>array('update', 'id'=>$model->id_weight_unit)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','WeightUnit'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_weight_unit),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','WeightUnit'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','WeightUnit')?> #<?php echo $model->id_weight_unit; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_weight_unit',
		'weight_unit_name',
	),
)); ?>
