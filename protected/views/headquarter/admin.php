<?php
/* @var $this HeadquarterController */
/* @var $model Headquarter */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Headquarters'))=>array('index'),
	Yii::t('actions','Manage'),
);

$this->menu=array(

	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Headquarter'), 'url'=>array('create')),
);?>
<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Headquarters')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'headquarter-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_headquarter',
		'id_user',
		'id_area',
		'headquarter_name',
		'headquarter_location',
		  array(
                    'name'=>'idCompany.company_name',
                    'value'=>'@$data->idCompany->company_name',
                    'filter'=>  CHtml::activeTextField($model, '_company'),
                    'visible'=> Yii::app()->user->checkAccess('Administrador'),                    
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
