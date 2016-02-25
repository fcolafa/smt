<?php
/* @var $this BridgeController */
/* @var $model Bridge */

$this->breadcrumbs=array(
	Yii::t('database','Bridges')=>array('admin'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ".Yii::t('database','Bridge'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Bridge'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Bridge')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>