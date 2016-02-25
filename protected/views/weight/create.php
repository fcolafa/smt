<?php
/* @var $this WeightController */
/* @var $model Weight */

$this->breadcrumbs=array(
	Yii::t('database','Weights')=>array('admin'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".Yii::t('database','Weight'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Weight'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Weight')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>