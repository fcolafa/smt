<?php
/* @var $this ReceptionController */
/* @var $model Reception */

$this->breadcrumbs=array(
	Yii::t('database','Receptions')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".Yii::t('database','Reception'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Reception'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Reception')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>