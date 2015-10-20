<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	Yii::t('database','Users')=>array('index'),
	Yii::t('actions','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".Yii::t('database','Users'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','Create')?> <?php echo Yii::t('database','Users')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>