<?php
/* @var $this SessionController */
/* @var $model Session */

$this->breadcrumbs=array(
	
	Yii::t('actions','Manage'),
);

$this->menu=array(
//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Session'), 'url'=>array('index')),
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#session-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('actions','Manage')?> <?php echo Yii::t('database','Sessions')?></h1>

<p>
<?php echo Yii::t('validation','You may optionally enter a comparison operator')?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('validation','or')?> <b>=</b>
) <?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?> .
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'session-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'afterAjaxUpdate'=>"function(){
                $.datepicker.setDefaults($.datepicker.regional['es']);
                $('#datepicker_for_due_date').datepicker({'dateFormat': 'yy-mm-dd'});

            }",  
	'columns'=>array(
		
                array('name'=>'idUser.user_name',
                    'value'=>'$data->idUser->user_name',
                    'filter'=>  CHtml::activeTextField($model, '_username'),
                    ),
                    array(
                        'name' => 'login',
                            'value'=>'Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->login))',

                    ),
		array(
			'class'=>'CButtonColumn',
                        'buttons'=>array(
                        'update'=>array(
                            'visible'=>'false',
                         ),
                            'view'=>array(
                            'visible'=>'false',
                         ),
                    ),
		),
	),
)); ?>
