<?php
/* @var $this HeadquarterController */
/* @var $model Headquarter */

$this->breadcrumbs=array(
	Yii::t('database','Headquarters')=>array('index','idu'=>$idu),
	$model->id_headquarter,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Headquarter'), 'url'=>array('index','idu'=>$idu)),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Headquarter'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Headquarter'), 'url'=>array('update', 'id'=>$model->id_headquarter,'idu'=>$idu)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Headquarter'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_headquarter),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Headquarter'), 'url'=>array('admin','idu'=>$idu)),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Headquarter')?> #<?php echo $model->id_headquarter; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'headquarter_name',
		'headquarter_location',
	),
)); ?>
