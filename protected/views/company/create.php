<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->breadcrumbs=array(
	Yii::t('database','Companies')=>array('admin'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ".Yii::t('database','Company'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Company'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Company')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>