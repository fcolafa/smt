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
 	jQuery('#Projects_presentationDate').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	}",
	'columns'=>array(
		'id_ticket',
		'id_embarkation',
		'id_user',
		               array(
                
                       'name' => 'ticket_date',
                        'value'=>'Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->ticket_date))',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'ticket_date',
                                        'language' => 'es',
                                       
                                        'htmlOptions' => array(
                                                'id' => 'Projects_presentationDate',
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
                                                'id' => 'Projects_presentationDate',
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
