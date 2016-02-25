<?php
/* @var $this ScheduleController */
/* @var $model Schedule */

$this->breadcrumbs=array(
	Yii::t('database','Schedules')=>array('admin'),
	$model->id_schedule,
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Schedule'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Schedule'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Schedule'), 'url'=>array('update', 'ids'=>$model->id_schedule)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Schedule'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','ids'=>$model->id_schedule),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Schedule'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Schedule')?> #<?php echo $model->id_schedule; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_schedule',
		'schedule_date',
		'initial_stock',
		         array(
                  
                'name'=>'ranch_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                   'value'=>  isset($model->ranch_date)?Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->ranch_date)):null
                
            ),
		'ranch_diesel',
		'id_headquarter',
		'final_stock',
		'day_comsuption',
             	     array(
                'name'=>'Horometro Motor Babor:',
                'value'=>"inicio:".$model->init_bb_motor." termino:".$model->finish_bb_motor,
      
            ),
             	     array(
                'name'=>'Horometro Motor Estribor:',
                'value'=>"inicio:".$model->init_eb_motor." termino:".$model->finish_eb_motor,
      
            ),
            
            
	
		'total_hours',
                	     array(
                'name'=>'Horas de servicio en el dia:',
                'value'=>"Horómetro Gen 1:".$model->gen1_hours." Horómetro Gen 2".$model->gen2_hours." Horómetro Gen 3:".$model->gen3_hours,
      
            ),
	),
)); ?>
<h4>Datos Recalada</h4>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

	
		    array(
                 'name'=>'arrive_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>  isset($model->arrive_date)?Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->arrive_date)):null
                
                    ),
           
           
		'horometer_bb',
		'horometer_eb',
		'horometer_gen1',
		'horometer_gen2',
		'horometer_gen3',
		'arrrive_stock',
		'total_water_charged',
	
	),
)); ?>
<h4>Otros Datos</h4>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

	
	'earthing',
		     array(
                'name'=>'Ingresado Por:',
                'value'=>CHtml::link(
                        ' '.$model->idUser->user_names.' '.
                        ' '.$model->idUser->user_lastnames
                        ,array('users/viewClient','id'=>$model->id_user)),
                'type'=>'raw',
                'visible'=>Yii::app()->user->checkAccess('Administrador')
            ),
		'notes',
	),
)); ?>
