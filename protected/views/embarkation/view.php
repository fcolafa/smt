<?php
/* @var $this EmbarkationController */
/* @var $model Embarkation */

$this->breadcrumbs=array(
	Yii::t('database','Embarkations')=>array('admin'),
	$model->id_embarkation,
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Embarkation'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Embarkation'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Embarkation'), 'url'=>array('update', 'id'=>$model->id_embarkation)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Embarkation'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_embarkation),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Embarkation'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Embarkation')?> #<?php echo $model->id_embarkation; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_embarkation',
		'embarkation_name',
	),
)); ?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ware-grid',
	'dataProvider'=>$recep->searchCurrentEmbarkation($model->id_embarkation),
        'filter'=>$recep,
	'columns'=>array(
              array(
                    'name'=>'idGuide.num_guide',
                    'value'=>'CHtml::link($data->idGuide->num_guide , array("guide/view","id"=>$data->idGuide->id_guide));',
                    'type'=>'raw',
                    'filter'=>  CHtml::activeTextField($recep, '_numguide'),
                ),
            'weightprovider',
            'weighttype',
            'amount_weight', 
            'amount_left', 
            'amount_embarkation',
           
          ),
       )); 

?>
