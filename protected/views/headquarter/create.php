<?php
/* @var $this HeadquarterController */
/* @var $model Headquarter */

$this->breadcrumbs=array(
	Yii::t('database','Headquarters')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ".Yii::t('database','Headquarter'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Headquarter'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Headquarter')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>