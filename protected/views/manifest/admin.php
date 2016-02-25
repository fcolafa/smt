<?php
/* @var $this ManifestController */
/* @var $model Manifest */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Manifests'))=>array('admin'),
	Yii::t('actions','Manage'),
);

$this->menu=array(
//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Manifest'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Manifest'), 'url'=>array('create')),
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
       'afterAjaxUpdate'=>"function() {
 	
 	jQuery('#manifestdate').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 							}",
	'columns'=>array(
		'id_manifest',
		
                    array(
                
                       'name' => 'manifest_date',
                        'value'=>'empty($data->manifest_date)?"":Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime(@$data->manifest_date))',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'manifest_date',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'manifestdate',
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
                    'class'=>'CButtonColumn',
                   
                   
		),
	),
)); ?>
