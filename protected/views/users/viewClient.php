<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	
	$model->user_name,
);
if(Yii::app()->user->CheckAccess('Cliente')){
    $this->menu=array(
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Profile'), 'url'=>array('updateClient', 'id'=>$model->id_user)),

);
    
}else {
$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Client'), 'url'=>array('indexClient')),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Client'), 'url'=>array('createClient')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Client'), 'url'=>array('updateClient', 'id'=>$model->id_user)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Client'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteClient','id'=>$model->id_user),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Client'), 'url'=>array('adminClient')),
);
}
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo $model->user_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_user',
		'user_name',
		  array(
                'name'=>'date_create',
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->date_create))
                ),
		'email',
		'user_names',
		'user_lastnames',
		'user_rut',
                array(
                'name'=>'idCompany.company_name',
                'visible'=>Yii::app()->user->checkAccess('Administrador'),
        ),
	),
)); ?>
