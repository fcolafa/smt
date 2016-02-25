<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Schedules'))=>array('admin'),
	Yii::t('actions','Manage'),
);


$this->menu=array(

	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Schedule'), 'url'=>array('create')),
);?>
<script type="text/javascript">
'onSave' => 'js: function(e, params) {
    alert("Saved value: " + params.newValue);
}'   
</script>
<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Schedules')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>
<?php 
 $this->widget('zii.widgets.grid.CGridView', array(
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
)); 
?>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'schegrid',
   'itemsCssClass' => 'table-bordered items',
   'dataProvider' => $model->search(),
   'columns'=>array(
       
       
       array( 
              'class' => 'editable.EditableColumn',
              'name'  => 'schedule_date',
              'headerHtmlOptions' => array('style' => 'width: 110px'),
              'editable' => array(
                  'type'          => 'datetime',
               //   'viewformat'    => 'dd-mm-yyyy',
                  'url'           => $this->createUrl('schedule/updateSchedule'),
                  'placement'     => 'right',
                  
              )
         ), 
             array(
           'class' => 'editable.EditableColumn',
           'name' => 'idEmbarkation.embarkation_name',
          'value'=>'$data->idEmbarkation->embarkation_name',
           'headerHtmlOptions' => array('style' => 'width: 110px'),
           'editable' => array(    //editable section
                  //'apply'      => '$data->initial_stock', //can't edit deleted users
               
                  'type'      => 'select',
                  'attribute' => 'id_embarkation',
                  'url'        => $this->createUrl('schedule/updateSchedule'),
                  'source'    => Editable::source(Embarkation::model()->findAll(), 'id_embarkation', 'embarkation_name'),
                  'placement'  => 'right',
                  'title'=>'Seleccione Nave Asociada',
//                    'options'  => array(    //custom display 
//                     'display' => 'js: function(value, sourceData) {
//                          var selected = $.grep(sourceData, function(o){ return value == o.value; }),
//                              colors = {1: "green", 2: "blue", 3: "red", 4: "gray"};
//                          $(this).text(selected[0].text).css("color", colors[value]);    
//                      }'
//                  ),
                 //onsave event handler 
                 'onSave' => 'js: function(e, params) {
                      console && console.log("saved value: "+params.newValue);
                 }',
                 //source url can depend on some parameters, then use js function:
                 /*
                 'source' => 'js: function() {
                      var dob = $(this).closest("td").next().find(".editable").text();
                      var username = $(this).data("username");
                      return "?r=site/getStatuses&user="+username+"&dob="+dob;
                 }',
                 'htmlOptions' => array(
                     'data-username' => '$data->user_name'
                 )
                 */
              )
         ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'idHeadquarter.headquarter_name',
          'value'=>'$data->idHeadquarter->headquarter_name',
           'headerHtmlOptions' => array('style' => 'width: 110px'),
           'editable' => array(    //editable section
                  //'apply'      => '$data->initial_stock', //can't edit deleted users
               
                  'type'      => 'select',
                  'attribute' => 'id_headquarter',
                  'url'        => $this->createUrl('schedule/updateSchedule'),
                  'source'    => Editable::source(Headquarter::model()->findAll(), 'id_headquarter', 'headquarter_name'),
                  'placement'  => 'right',
                  'title'=>'Seleccione Nave Asociada',
//                    'options'  => array(    //custom display 
//                     'display' => 'js: function(value, sourceData) {
//                          var selected = $.grep(sourceData, function(o){ return value == o.value; }),
//                              colors = {1: "green", 2: "blue", 3: "red", 4: "gray"};
//                          $(this).text(selected[0].text).css("color", colors[value]);    
//                      }'
//                  ),
                 //onsave event handler 
                 'onSave' => 'js: function(e, params) {
                      console && console.log("saved value: "+params.newValue);
                 }',
                 //source url can depend on some parameters, then use js function:
                 /*
                 'source' => 'js: function() {
                      var dob = $(this).closest("td").next().find(".editable").text();
                      var username = $(this).data("username");
                      return "?r=site/getStatuses&user="+username+"&dob="+dob;
                 }',
                 'htmlOptions' => array(
                     'data-username' => '$data->user_name'
                 )
                 */
              )
         ),
          array(
           'class' => 'editable.EditableColumn',
           'name' => 'initial_stock',
           'headerHtmlOptions' => array('style' => 'width: 110px'),
           'editable' => array(    //editable section
                  //'apply'      => '$data->initial_stock', //can't edit deleted users
                  'url'        => $this->createUrl('schedule/updateSchedule'),
                  'placement'  => 'right',
              )               
        ),
         array( 
              'class' => 'editable.EditableColumn',
              'name'  => 'ranch_date',
              'headerHtmlOptions' => array('style' => 'width: 110px'),
              'editable' => array(
                  'type'          => 'datetime',
               //   'viewformat'    => 'dd-mm-yyyy',
                  'url'           => $this->createUrl('schedule/updateSchedule'),
                  'placement'     => 'right',
                  
              )
         ), 
       array(
           'class' => 'editable.EditableColumn',
           'name' => 'ranch_diesel',
           'headerHtmlOptions' => array('style' => 'width: 110px'),
           'editable' => array(    //editable section
                  //'apply'      => '$data->initial_stock', //can't edit deleted users
                  'url'        => $this->createUrl('schedule/updateSchedule'),
                  'placement'  => 'right',
              )               
        ),
       array(
           'class' => 'editable.EditableColumn',
           'name' => 'delivery_DO',
           'headerHtmlOptions' => array('style' => 'width: 110px'),
           'editable' => array(    //editable section
                  //'apply'      => '$data->initial_stock', //can't edit deleted users
                  'url'        => $this->createUrl('schedule/updateSchedule'),
                  'placement'  => 'right',
              )               
        ),
       array(
           'class' => 'editable.EditableColumn',
           'name' => 'final_stock',
           'headerHtmlOptions' => array('style' => 'width: 110px'),
           'editable' => array(    //editable section
                  //'apply'      => '$data->initial_stock', //can't edit deleted users
                  'url'        => $this->createUrl('schedule/updateSchedule'),
                  'placement'  => 'right',
              )               
        ),
 
         
        
          
     
        
   
         array( 
              'class' => 'editable.EditableColumn',
              'name'  => 'init_bb_motor',
              'headerHtmlOptions' => array('style' => 'width: 110px'),
              'editable' => array(
                  //'type'=> array('number',
                 // 'step' =>'any'), 
                  
               //   'viewformat'    => 'dd-mm-yyyy',
                  'url'           => $this->createUrl('schedule/updateSchedule'),
                  'placement'     => 'right',
                  
              )
         ), 
         array( 
              'class' => 'editable.EditableColumn',
              'name'  => 'finish_bb_motor',
              'headerHtmlOptions' => array('style' => 'width: 110px'),
              'editable' => array(
                  //'type'=> array('number',
                 // 'step' =>'any'), 
                  
               //   'viewformat'    => 'dd-mm-yyyy',
                  'url'           => $this->createUrl('schedule/updateSchedule'),
                  'placement'     => 'right',
                  
              )
         ), 
         array( 
              'class' => 'editable.EditableColumn',
              'name'  => 'init_eb_motor',
              'headerHtmlOptions' => array('style' => 'width: 110px'),
              'editable' => array(
                  //'type'=> array('number',
                 // 'step' =>'any'), 
                  
               //   'viewformat'    => 'dd-mm-yyyy',
                  'url'           => $this->createUrl('schedule/updateSchedule'),
                  'placement'     => 'right',
                  
              )
         ), 
//        array(
//           'class' => 'editable.EditableColumn',
//           'name' => 'email',
//           'headerHtmlOptions' => array('style' => 'width: 110px'),
//           'editable' => array(    //editable section
//                
//                  'url'        => $this->createUrl('schedule/test', array('id'=>$model->id_user)),
//                  'placement'  => 'right',
//              )               
//        ),
//           array( 
//              'class' => 'editable.EditableColumn',
//              'name'  => 'arrive_date',
//              'headerHtmlOptions' => array('style' => 'width: 100px'),
//              'editable' => array(
//                  'type'          => 'date',
//                  'viewformat'    => 'dd.mm.yyyy',
//                  'url'           => $this->createUrl('schedule/updateUser'),
//                  'placement'     => 'right',
//              )
//         ), 
   ),
)); 
?>


