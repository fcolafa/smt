<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->breadcrumbs=array(
	Yii::t('database','Companies')=>array('index'),
	$model->id_company=>array('view','id'=>$model->id_company),
	Yii::t('actions','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Company'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Company'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". Yii::t('database','Company'), 'url'=>array('view', 'id'=>$model->id_company)),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Company'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('actions','Update')?> <?php echo Yii::t('database','Company')?> <?php echo $model->id_company; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>