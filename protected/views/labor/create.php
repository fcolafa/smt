<?php
/* @var $this LaborController */
/* @var $model Labor */

$this->breadcrumbs=array(
	Yii::t('database','Labors')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".Yii::t('database','Labor'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Labor'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Labor')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>