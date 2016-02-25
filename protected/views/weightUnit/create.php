<?php
/* @var $this WeightUnitController */
/* @var $model WeightUnit */

$this->breadcrumbs=array(
	Yii::t('database','Weight Units')=>array('admin'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".Yii::t('database','WeightUnit'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','WeightUnit'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','WeightUnit')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>