<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	
	$model->user_name,
);

$this->menu=array(
	
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Profile'), 'url'=>array('updateClient', 'id'=>$model->id_user)),

);

?>

<h1><?php echo Yii::t('database','Profile')?> <?php echo $model->user_name; ?></h1>

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
                'user_phone',
                array(
                'name'=>'idCompany.company_name',
                'visible'=>Yii::app()->user->checkAccess('Administrador'),
        ),
            
	),
)); ?>
