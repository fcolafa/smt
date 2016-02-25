<?php
/* @var $this EmbarkationController */
/* @var $model Embarkation */

$this->breadcrumbs=array(
	Yii::t('database','Embarkations')=>array('admin'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ".Yii::t('database','Embarkation'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Embarkation'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Embarkation')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>