<?php
/* @var $this WeightTypeController */
/* @var $model WeightType */

$this->breadcrumbs=array(
	Yii::t('database','Weight Types')=>array('index'),
	$model->id_weight_type,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','WeightType'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','WeightType'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','WeightType'), 'url'=>array('update', 'id'=>$model->id_weight_type)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','WeightType'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_weight_type),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','WeightType'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','WeightType')?> #<?php echo $model->id_weight_type; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_weight_type',
		'weight_type_name',
	),
)); ?>
