<?php
/* @var $this HeadquarterController */
/* @var $model Headquarter */

$this->breadcrumbs=array(
	Yii::t('database','Headquarters')=>array('admin'),
	$model->id_headquarter=>array('view','id'=>$model->id_headquarter),
	Yii::t('actions','Update'),
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Headquarter'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Headquarter'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Headquarter'), 'url'=>array('view', 'id'=>$model->id_headquarter)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Headquarter'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Headquarter')?> <?php echo $model->id_headquarter; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>