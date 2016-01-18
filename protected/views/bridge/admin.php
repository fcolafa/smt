<?php
/* @var $this BridgeController */
/* @var $model Bridge */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Bridges'))=>array('index'),
	Yii::t('actions','Manage'),
);

$this->menu=array(
//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Bridge'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Bridge'), 'url'=>array('create')),
);?>
<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Bridges')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bridge-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'afterAjaxUpdate'=>"function() {
 	jQuery('#bridge_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	jQuery('#bridge_date_arrive').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	jQuery('#bridge_date_sailing').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	}",
	'columns'=>array(
		
               array(
                
                       'name' => 'bridge_date',
                        'value'=>'!empty($data->bridge_date)?Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->bridge_date)):""',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'bridge_date',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'bridge_date',
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
                
                       'name' => 'bridge_date_arrive',
                        'value'=>'!empty($data->bridge_date_arrive)?Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->bridge_date_arrive)):""',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'bridge_date_arrive',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'bridge_date_arrive',
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
                       'name'=>'idEmbarkation.embarkation_name',
                       'value'=>'!empty($data->idEmbarkation->embarkation_name)?$data->idEmbarkation->embarkation_name:"No Asignado"',
                       'filter'=>  CHtml::activeTextField($model, '_embarkation_name'),
                       ),
                array(
                   'name'=>'idHeadquarter.headquarter_name',
                   'value'=>'$data->idHeadquarter->headquarter_name',
                   'filter'=>  CHtml::activeTextField($model, '_headquarter_name'),
                   ), 
		'init_charge_time',
		'finish_charge_time',
                array(
                
                       'name' => 'bridge_date_sailing',
                        'value'=>'!empty($data->bridge_date_sailing)?Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->bridge_date_sailing)):""',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'bridge_date_sailing',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'bridge_date_sailing',
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
		
		/*
		'id_user',
		'bridge_notes',
		'bridge_date',
		*/
               
		array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                        'view'=>array(
                            'url'=>'Yii::app()->createUrl("bridge/view",array( "ids"=>"$data->id_bridge"))',
                         ),
                            'update'=>array(
                               
                            'url'=>'Yii::app()->createUrl("bridge/update",array("ids"=>$data["id_bridge"]))',
                          
                         ),
                            'delete'=>array(
                               
                            'url'=>'Yii::app()->createUrl("bridge/delete",array("ids"=>$data["id_bridge"]))',
                          
                         ),
                       
                      
                        ),
		),
	),
)); ?>
