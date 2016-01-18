<?php
/* @var $this HeadquarterController */
/* @var $model Headquarter */

$this->breadcrumbs=array(
	Yii::t('database','Headquarters')=>array('admin'),
	$model->id_headquarter,
);

$this->menu=array(
	
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Headquarter'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Headquarter'), 'url'=>array('update', 'id'=>$model->id_headquarter)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Headquarter'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_headquarter),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Headquarter'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Headquarter')?> : <?php echo $model->headquarter_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_headquarter',
		'headquarter_name',
		'headquarter_type',
		'idCompany.company_name',
	),
)); ?>

<h4> Carga Actual bodega</h4>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ware-grid',
	'dataProvider'=>$recep->searchCurrent($model->id_headquarter),
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
            'amount_headquarter',
           
          ),
       )); 

?>
<h4> Moviemiento de Carga</h4>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'weight-grid',
	'dataProvider'=>$ware->searchHead($model->id_headquarter),
        'filter'=>$ware,
        'afterAjaxUpdate'=>"function() {
 	jQuery('#_receptionDate').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));						}",
	'columns'=>array(
                   
                    array(
                       'name' => 'idReception.reception_date',
                        'value'=>'Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->idReception->reception_date))',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $ware,
                                        'attribute' => '_receptionDate',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => '_receptionDate',
                                                'dateFormat' => 'yy-mm-dd',
                                        ),
                                        'options' => array(  // (#3)
                  'showOn' => 'focus', 
                  'dateFormat' => 'yy-mm-dd',
                  'showOtherMonths' => true,
                  'selectOtherMonths' => true,
                  'changeMonth' => true,
                  'changeYear' => true,
                  'showButtonPanel' => true,
                )
                                ),
                                true),
                
              
            ),
        
                 array(
                    'name'=>'idWeight.idGuide.num_guide',
                    'value'=>'CHtml::link($data->idWeight->idGuide->num_guide , array("guide/view","id"=>$data->idWeight->idGuide->id_guide));',
                    'type'=>'raw',
                    'filter'=>  CHtml::activeTextField($ware, '_numguide'),
                ),
                 array(
                    'name'=>'idWeight.weighttype',
                    'value'=>'$data->idWeight->weighttype',
                    'filter'=>  CHtml::activeTextField($ware, '_weightype'),       
                ),
            
            'amount_warehouse',
            
	),
)); ?>
