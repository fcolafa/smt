<?php
/* @var $this ProviderController */
/* @var $model Provider */

$this->breadcrumbs=array(
	Yii::t('database','Providers')=>array('index'),
	$model->id_provider=>array('view','id'=>$model->id_provider),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Provider'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Provider'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Provider'), 'url'=>array('view', 'id'=>$model->id_provider)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Provider'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Provider')?> <?php echo $model->id_provider; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>