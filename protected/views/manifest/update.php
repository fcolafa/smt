<?php
/* @var $this ManifestController */
/* @var $model Manifest */

$this->breadcrumbs=array(
	Yii::t('database','Manifests')=>array('index'),
	$model->id_manifest=>array('view','id'=>$model->id_manifest),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Manifest'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Manifest'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Manifest'), 'url'=>array('view', 'id'=>$model->id_manifest)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Manifest'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Manifest')?> <?php echo $model->id_manifest; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>