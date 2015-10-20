<?php
/* @var $this WeightController */
/* @var $model Weight */

$this->breadcrumbs=array(
	Yii::t('database','Weights')=>array('index'),
	$model->id_weight=>array('view','id'=>$model->id_weight),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Weight'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Weight'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Weight'), 'url'=>array('view', 'id'=>$model->id_weight)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Weight'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Weight')?> <?php echo $model->id_weight; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>