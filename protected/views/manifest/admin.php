<?php
/* @var $this ManifestController */
/* @var $model Manifest */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Manifests'))=>array('index'),
	Yii::t('actions','Manage'),
);

$this->menu=array(
//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Manifest'), 'url'=>array('index')),
//	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Manifest'), 'url'=>array('create')),
);?>
<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Manifests')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'manifest-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_manifest',
		'manifest_date',
		 array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view} ',
                   
		),
	),
)); ?>
