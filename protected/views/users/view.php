<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	Yii::t('database','Users')=>array('index'),
	$model->id_user,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Users'), 'url'=>array('index'),'visible'=>  Yii::app()->user->checkAccess('Administrador')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Users'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Users'), 'url'=>array('update', 'id'=>$model->id_user)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Users'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_user),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Users')?> : <?php echo $model->user_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_user',
		'user_name',
		  array(
                'name'=>'date_create',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->date_create))
                ),
		'email',
                array(
                  'name'=>'Nombre Completo',
                  'value'=> $model->user_names ." ".$model->user_lastnames,
                ),
                'user_rut',
                'idCompany.company_name',
                'role',
                'user_phone',
	),
)); ?>
