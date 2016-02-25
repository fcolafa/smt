<?php
/* @var $this WeightController */
/* @var $model Weight */

$this->breadcrumbs=array(
	Yii::t('database','Weights')=>array('admin'),
	$model->id_weight,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Weight'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Weight'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Weight'), 'url'=>array('update', 'id'=>$model->id_weight)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Weight'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_weight),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Weight'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Weight')?> #<?php echo $model->id_weight; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_weight',
		'id_provider',
		'id_weight_type',
		'id_weigth_unit',
		'amount_weight',
		'guide_id_guide',
	),
)); ?>
