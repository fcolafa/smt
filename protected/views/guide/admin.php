<?php
/* @var $this GuideController */
/* @var $model Guide */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Guides'))=>array('index' ),
	Yii::t('actions','Manage'),
);

$this->menu=array(
array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Guide'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#guide-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Guides')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>



<?php 
if(Yii::app()->user->checkAccess('Cliente'))
  $filter=  $model->searchClient();
if(Yii::app()->user->checkAccess('Administrador'))
   $filter= $model->search();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'guide-grid',
	'dataProvider'=>$filter,
	'filter'=>$model,
        'afterAjaxUpdate'=>"function() {
 	jQuery('#Projects_presentationDate').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 							}",
	'columns'=>array(
		'id_guide',
		'num_guide',
           array(
                    'name'=>'idUser.idCompany.company_name',
                    'value'=>'$data->idUser->idCompany->company_name',
                    'filter'=>  CHtml::activeTextField($model, '_company'),
                    'visible'=> Yii::app()->user->checkAccess('Administrador'),
                    
                    ),
            array(
	       'name'=>'pdf_guide',
               'type'=>'raw',
               'value'=>'CHtml::link($data->pdf_guide,Yii::app()->createUrl("guide/UrlProcessing",array("url"=>Yii::app()->BaseUrl."/images/guides/".$data->pdf_guide)),array("target"=>"_blank"))',  
            ),
            array(
                
                       'name' => 'date_guide_create',
                        'value'=>'Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->date_guide_create))',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                
                                array(
                                        'model' => $model,
                                        'attribute' => 'date_guide_create',
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
			'class'=>'CButtonColumn',
                    'template'=>'{view} {delete}',
                    'buttons'=>array(
                        'view'=>array(
                            'url'=>'Yii::app()->controller->createUrl("view",array("id"=>"$data->id_guide"));',
                         ),
                            'update'=>array(
                            'url'=>'Yii::app()->controller->createUrl("update",array("id"=>"$data->id_guide"));',
                          
                         ),
                            'Seleccionar'=>array(
                                'label'=>'Seleccionar',
                                'url'=>'"#"',
                                //'onClick'=>'alert("Que lo remil pario...")'
                                //'htmlOptions'=>array('onClick'=>'javascript: alert("Que lo remil pario...");'),
                                //'click'=>'function(){alert("Going down!");}',
                                'click'=>'function(){parent.document.getElementById("miEntrada").value="'.'$data->id'.'";}',
                                //'click'=>'Yii::app()->clientScript->registerScript("myscript", "")',
                            ),
                      
                        ),
		),
	),
)); ?>
