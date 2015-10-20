<?php
/* @var $this WeightTypeController */
/* @var $model WeightType */

$this->breadcrumbs=array(
	Yii::t('database','Weight Types')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".Yii::t('database','WeightType'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','WeightType'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','WeightType')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>