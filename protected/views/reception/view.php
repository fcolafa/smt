<?php
/* @var $this ReceptionController */
/* @var $model Reception */

$this->breadcrumbs=array(
	Yii::t('database','Receptions')=>array('index'),
	$model->id_reception,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Reception'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Reception'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Reception'), 'url'=>array('update', 'id'=>$model->id_reception)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Reception'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_reception),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Reception'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Reception')?> #<?php echo $model->id_reception; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_reception',
		'id_headquarter',
		'recepction_date',
		'id_embarkation',
		'id_user',
	),
)); ?>
