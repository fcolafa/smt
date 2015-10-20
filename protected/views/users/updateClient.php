<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	$model->user_name=>array('viewClient','id'=>$model->id_user),
	Yii::t('actions','Update'),
);

$this->menu=array(

	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Users'), 'url'=>array('viewClient', 'id'=>$model->id_user)),
	
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','User')?> : <?php echo $model->user_name; ?></h1>

<?php $this->renderPartial('_formClient', array('model'=>$model)); ?>