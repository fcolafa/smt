<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	Yii::t('database','Users')=>array('index'),
	$model->id_user=>array('view','id'=>$model->id_user),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Users'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Users'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Users'), 'url'=>array('view', 'id'=>$model->id_user)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Users'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','User')?> : <?php echo $model->user_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>