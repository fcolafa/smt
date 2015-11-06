<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Tickets'))=>array('index'),
	Yii::t('actions','Manage'),
);

$this->menu=array(
array('label'=>Yii::t('actions','List')." ". Yii::t('database','Tickets'), 'url'=>array('index')),
array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Ticket'), 'url'=>array('create'),'visible'=>  Yii::app()->user->checkAccess('Cliente')),
);?>
<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Tickets')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ticket-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
       'afterAjaxUpdate'=>"function() {
 	jQuery('#ticket_date_incident').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	jQuery('#ticket_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	
}",
	'columns'=>array(
		'id_ticket',
                 array(
                    'name'=>'idEmbarkation.embarkation_name',
                    'value'=>'$data->idEmbarkation->embarkation_name',
                    'filter'=>  CHtml::activeTextField($model, '_embarkation_name'),
                    ),
                 array(
                    'name'=>'idHeadquarter.headquarter_name',
                    'value'=>'$data->idHeadquarter->headquarter_name',
                    'filter'=>  CHtml::activeTextField($model, '_headquarter_name'),
                    ),
		  array(
                    'name'=>'idUser.user_name',
                    'value'=>'$data->idUser->user_name',
                    'filter'=>  CHtml::activeTextField($model, '_user_name'),
                    ),
              array(
                    'name'=>'idUser.user_names',
                    'value'=>'$data->idUser->user_names',
                    'filter'=>  CHtml::activeTextField($model, '_user_names'),
                    ),
              array(
                    'name'=>'idUser.user_lastnames',
                    'value'=>'$data->idUser->user_lastnames',
                    'filter'=>  CHtml::activeTextField($model, '_user_lastnames'),
                    ),
		               array(
                
                       'name' => 'ticket_date_incident',
                        'value'=>'Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->ticket_date_incident))',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'ticket_date_incident',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'ticket_date_incident',
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
                
                       'name' => 'ticket_date',
                        'value'=>'Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->ticket_date))',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'ticket_date',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'ticket_date',
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
            
		'ticket_status',
            
            
 
		array(
			'class'=>'CButtonColumn',
                      'buttons'=>array(
                       
                            'update'=>array(
                            'visible'=>'false',
                         ),
                             'delete'=>array(
                            'visible'=>'false',
                         ),
                          ),
		),
	),
)); ?>
