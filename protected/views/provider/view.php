<?php
/* @var $this ProviderController */
/* @var $model Provider */

$this->breadcrumbs=array(
	Yii::t('database','Providers')=>array('admin'),
	$model->id_provider,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Provider'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Provider'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Provider'), 'url'=>array('update', 'id'=>$model->id_provider)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Provider'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_provider),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Provider'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Provider')?> #<?php echo $model->id_provider; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_provider',
		'provider_name',
	),
)); ?>
