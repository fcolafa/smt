<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	Yii::t('database',Yii::t('database','Users'))=>array('index'),
	Yii::t('actions','Manage'),
);

$this->menu=array(

	array('label'=>Yii::t('actions','Create')." ".Yii::t('database','Users'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Users')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->searchAdmin(),
	'filter'=>$model,
      'afterAjaxUpdate'=>"function(){
                $.datepicker.setDefaults($.datepicker.regional['es']);
                $('#datepicker_for_due_date').datepicker({'dateFormat': 'yy-mm-dd'});

            }",  
	'columns'=>array(
		'id_user',
		'user_name',
		      array(
                        'name' => 'date_create',
                        'value'=>'Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->date_create))',
                          ),
//                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                            'model'=>$model, 
//                            'attribute'=>'date_create', 
//                            'language' => 'es',
//                         //   'i18nScriptFile' => 'jquery.ui.datepicker-en.js', 
//                            'htmlOptions' => array(
//                                'id' => 'datepicker_for_due_date',
//                                'size' => '10',
//                            ),
//                            'defaultOptions' => array(  
//                                'showOn' => 'focus', 
//                                'dateFormat' => 'yy-mm-dd',
//                                'showOtherMonths' => true,
//                                'selectOtherMonths' => true,
//                                'changeMonth' => true,
//                                'changeYear' => true,
//                                'showButtonPanel' => true,
//                              
//                            )
//                        ), 
//                        true),
//                       
//                    ),
//             
            'email',
                'role',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
