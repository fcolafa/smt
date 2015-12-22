<?php
/* @var $this ManifestController */
/* @var $model Manifest */

$this->breadcrumbs=array(
	Yii::t('database','Manifests')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Manifest')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>