<?php
/* @var $this WeightTypeController */
/* @var $model WeightType */

$this->breadcrumbs=array(
	Yii::t('database','Weight Types')=>array('index'),
	$model->id_weight_type=>array('view','id'=>$model->id_weight_type),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','WeightType'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','WeightType'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','WeightType'), 'url'=>array('view', 'id'=>$model->id_weight_type)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','WeightType'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','WeightType')?> <?php echo $model->id_weight_type; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>