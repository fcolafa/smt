<?php
/* @var $this WeightUnitController */
/* @var $model WeightUnit */

$this->breadcrumbs=array(
	Yii::t('database','Weight Units')=>array('index'),
	$model->id_weight_unit=>array('view','id'=>$model->id_weight_unit),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','WeightUnit'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','WeightUnit'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','WeightUnit'), 'url'=>array('view', 'id'=>$model->id_weight_unit)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','WeightUnit'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','WeightUnit')?> <?php echo $model->id_weight_unit; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>