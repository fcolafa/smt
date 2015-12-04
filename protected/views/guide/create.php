<?php
/* @var $this GuideController */
/* @var $model Guide */

$this->breadcrumbs=array(
	Yii::t('database','Guides')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Guide'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Guide')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,
          )); ?>