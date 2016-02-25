<?php
/* @var $this BridgeController */
/* @var $model Bridge */

$this->breadcrumbs=array(
	Yii::t('database','Bridges')=>array('admin'),
	$model->id_bridge=>array('view','id'=>$model->id_bridge),
	Yii::t('actions','Update'),
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Bridge'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Bridge'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Bridge'), 'url'=>array('view', 'ids'=>$model->id_bridge)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Bridge'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Bridge')?> <?php echo $model->id_bridge; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>