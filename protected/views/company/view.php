<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->breadcrumbs=array(
	Yii::t('database','Companies')=>array('index'),
	$model->id_company,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Company'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Company'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Company'), 'url'=>array('update', 'id'=>$model->id_company)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Company'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_company),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Company'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Company')?> #<?php echo $model->id_company; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_company',
		'company_name',
	),
)); ?>
