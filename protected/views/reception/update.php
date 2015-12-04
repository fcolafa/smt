<?php
/* @var $this ReceptionController */
/* @var $model Reception */

$this->breadcrumbs=array(
	Yii::t('database','Receptions')=>array('index'),
	$model->id_reception=>array('view','id'=>$model->id_reception),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Reception'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Reception'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Reception'), 'url'=>array('view', 'id'=>$model->id_reception)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Reception'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Reception')?> <?php echo $model->id_reception; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>