<?php
/* @var $this LaborController */
/* @var $model Labor */

$this->breadcrumbs=array(
	Yii::t('database','Labors')=>array('index'),
	$model->id_labor=>array('view','id'=>$model->id_labor),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Labor'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Labor'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Labor'), 'url'=>array('view', 'id'=>$model->id_labor)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Labor'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Labor')?> <?php echo $model->id_labor; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>