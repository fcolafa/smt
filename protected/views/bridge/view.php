<?php
/* @var $this BridgeController */
/* @var $model Bridge */

$this->breadcrumbs=array(
	Yii::t('database','Bridges')=>array('index'),
	$model->id_bridge,
);

$this->menu=array(
	//array('label'=>Yii::t('actions','List')." ". Yii::t('database','Bridge'), 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Bridge'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Bridge'), 'url'=>array('update', 'ids'=>$model->id_bridge)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Bridge'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','ids'=>$model->id_bridge),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Bridge'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Bridge')?> #<?php echo $model->id_bridge; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_bridge',
            
                  array(
                   'name'=>'bridge_date_arrive',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                   'value'=>  isset($model->bridge_date)?Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->bridge_date)):''
                
            ),
		'idHeadquarter.headquarter_name',
		'idEmbarkation.embarkation_name',
		
            array(
                   'name'=>'bridge_date_arrive',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                   'value'=>  isset($model->ranch_date)?Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->bridge_date_arrive)):null
                
            ),
		'init_charge_time',
		'finish_charge_time',
		
                array(
                   'name'=>'bridge_date_sailing',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                   'value'=>  isset($model->ranch_date)?Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->bridge_date_sailings)):null
                
            ),
            
		      array(
                'name'=>'Ingresado Por:',
                'value'=>CHtml::link(
                        ' '.$model->idUser->user_names.' '.
                        ' '.$model->idUser->user_lastnames
                        ,array('users/viewClient','id'=>$model->id_user)),
                'type'=>'raw',
                'visible'=>Yii::app()->user->checkAccess('Administrador')
            ),
		'bridge_notes',
		
	),
)); ?>
