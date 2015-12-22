<?php
/* @var $this ManifestController */
/* @var $model Manifest */

$this->breadcrumbs=array(
	Yii::t('database','Manifests')=>array('index'),
	$model->id_manifest,
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Manifest'), 'url'=>array('index')),
	//array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Manifest'), 'url'=>array('create')),
	//array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Manifest'), 'url'=>array('update', 'id'=>$model->id_manifest)),
	//array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Manifest'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_manifest),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Manifest'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Manifest')?> #<?php echo $model->id_manifest; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_manifest',
               array(
                //'name'=>'manifest_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->manifest_date))
             ),
	),
)); ?>

<h4> Guias asociadas:</h4>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reception-grid',
	'dataProvider'=>$has->searchGuide(),
	'columns'=>array(
                
               
//             array(
//                'name'=>'_manifestdate',
//                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
//                'value'=>'Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($data->_manifestdate))',
//             ),
            
              array(
                'name'=>'num_guide',
                'value'=>'CHtml::link($data->num_guide,array("guide/view","id"=>$data->id_guide))',
                'type'=>'raw',
            ),
 
          ),
       )); 

?>
