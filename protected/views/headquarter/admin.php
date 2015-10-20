<?php
/* @var $this HeadquarterController */
/* @var $model Headquarter */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Headquarters'))=>array('index','idu'=>$idu),
	Yii::t('actions','Manage'),
);

$this->menu=array(
    array('label'=>Yii::t('actions','List')." ". Yii::t('database','Headquarter'), 'url'=>array('index','idu'=>$idu)),
    array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Headquarter'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#headquarter-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Headquarters')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>

<?php echo CHtml::link(Yii::t('actions','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'headquarter-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'headquarter_name',
		'headquarter_location',
		array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                           'view'=>array(
                               'url'=>'Yii::app()->controller->createUrl("view",array("id"=>"$data->id_headquarter","idu"=>"'.$idu.'"));',
                            ),
                               'update'=>array(
                               'url'=>'Yii::app()->controller->createUrl("update",array("id"=>"$data->id_headquarter","idu"=>"'.$idu.'"));',
                            ),
                            ),
		),
	),
)); ?>
