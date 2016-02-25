<?php
/* @var $this ManifestController */
/* @var $model Manifest */

$this->breadcrumbs=array(
	Yii::t('database','Manifests')=>array('admin'),
	$model->id_manifest,
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Manifest'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Manifest'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Manifest'), 'url'=>array('update', 'id'=>$model->id_manifest)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Manifest'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_manifest),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Manifest'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Manifest')?> #<?php echo $model->id_manifest; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_manifest',
            
          
		'idEmbarkation.embarkation_name',
	
		'idHeadquarter.headquarter_name',
		
		
               array(
                'name'=>'manifest_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->manifest_date))
             ),
               array(
                'name'=>'manifest_charge_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>empty($model->manifest_charge_date)?null:Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->manifest_charge_date))
             ),
               array(
                'name'=>'manifest_sailing',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>empty($model->manifest_sailing)?null:Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->manifest_sailing))
             ),
               array(
                'name'=>'manifest_return',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>empty($model->manifest_return)?null:Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->manifest_return))
             ),
            'manifest_observation',
	),
)); ?>

<h4> Carga asociada:</h4>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'manifest-weight-grid',
	'dataProvider'=>$has->searchManifestWeight($model->id_manifest),
        'filter'=>$has,
	'columns'=>array(
                
                
               
//             array(
//                'name'=>'_manifestdate',
//                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
//                'value'=>'Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($data->_manifestdate))',
//             ),
            
              array(
                'name'=>'idGuide.num_guide',
                'value'=>'CHtml::link($data->idGuide->num_guide,array("guide/view","id"=>$data->idGuide->id_guide))',
                'type'=>'raw',
                'filter'=>  CHtml::activeTextField($has, '_numguide'),
            ),
            'weightprovider',
            'weighttype',
            'amount_weight',
            'idWeightUnit.weight_unit_name',
 
          ),
       )); 

?>
<?php

  echo CHtml::link('<div  class="messageButtonb blue">
	    	<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/icon-xls.png" alt="Generar xls"  width="15%" />
	    	<div class=""><h4>Generar Manifiesto</h4></div>
		</div>', 
		array('manifest/manifestToExcel','id'=>$model->id_manifest),
                array('confirm' => 'Esta seguro Desea generar y el manifiesto??'));     

?> 
