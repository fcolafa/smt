<?php
/* @var $this WeightUnitController */
/* @var $model WeightUnit */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Weight Units'))=>array('admin'),
	Yii::t('actions','Manage'),
);

$this->menu=array(
array('label'=>Yii::t('actions','List')." ". Yii::t('database','WeightUnit'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','WeightUnit'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#weight-unit-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Weight Units')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'weight-unit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_weight_unit',
		'weight_unit_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
