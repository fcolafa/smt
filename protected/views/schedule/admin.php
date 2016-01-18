<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Schedules'))=>array('index'),
	Yii::t('actions','Manage'),
);

$this->menu=array(

	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Schedule'), 'url'=>array('create')),
);?>
<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Schedules')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'schedule-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'afterAjaxUpdate'=>"function() {
 	jQuery('#schedule_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	jQuery('#ranch_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	}",
	'columns'=>array(
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
	
              array(
                
                       'name' => 'schedule_date',
                        'value'=>'!empty($data->schedule_date)?Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->schedule_date)):""',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'schedule_date',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'schedule_date',
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
		'initial_stock',
	
            
                  array(
                
                       'name' => 'ranch_date',
                        'value'=>'!empty($data->ranch_date)?Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->ranch_date)):""',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'ranch_date',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'ranch_date',
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
		//'ranch_diesel',
				
		//'final_stock',
		//'day_comsuption',
		//'init_bb_motor',
		//'finish_bb_motor',
		//'init_eb_motor',
		//'finish_eb_motor',
		//'total_hours',
		//'gen1_hours',
		//'gen2_hours',
		//'gen3_hours',
		'arrive_date',
		//'horometer_bb',
		//'horometer_eb',
		//'horometer_gen1',
		//'horometer_gen2',
		//'horometer_gen3',
		//'arrrive_stock',
		//'total_water_charged',
		//'earthing',
		//'id_user',
		'notes',
		
		   array(
			'class'=>'CButtonColumn',
                    //'template'=>'{view} {delete}',
                    'buttons'=>array(
                        'view'=>array(
                            'url'=>'Yii::app()->createUrl("schedule/view",array( "ids"=>"$data->id_schedule"))',
                         ),
                            'update'=>array(
                               
                            'url'=>'Yii::app()->createUrl("schedule/update",array("ids"=>$data["id_schedule"]))',
                          
                         ),
                            'delete'=>array(
                               
                            'url'=>'Yii::app()->createUrl("schedule/delete",array("ids"=>$data["id_schedule"]))',
                          
                         ),
                       
                      
                        ),
		),
	),
)); ?>
