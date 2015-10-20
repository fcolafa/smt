<?php
/* @var $this GuideController */
/* @var $model Guide */

$this->breadcrumbs=array(
	Yii::t('database','Guides')=>array('index','idu'=>$idu),
	$model->id_guide=>array('view','id'=>$model->id_guide),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Guide'), 'url'=>array('index', 'idu'=>$idu)),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Guide'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Guide'), 'url'=>array('view', 'id'=>$model->id_guide,  'idu'=>$idu)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Guide'), 'url'=>array('admin', 'idu'=>$idu)),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Guide')?> <?php echo $model->id_guide; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,  
        'weight'=>$weight,
       )); ?>