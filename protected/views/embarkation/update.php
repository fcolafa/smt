<?php
/* @var $this EmbarkationController */
/* @var $model Embarkation */

$this->breadcrumbs=array(
	Yii::t('database','Embarkations')=>array('index'),
	$model->id_embarkation=>array('view','id'=>$model->id_embarkation),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Embarkation'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Embarkation'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Embarkation'), 'url'=>array('view', 'id'=>$model->id_embarkation)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Embarkation'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Embarkation')?> <?php echo $model->id_embarkation; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>