<?php
/* @var $this ProviderController */
/* @var $model Provider */

$this->breadcrumbs=array(
	Yii::t('database','Providers')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".Yii::t('database','Provider'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Provider'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Provider')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>