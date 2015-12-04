<?php
/* @var $this GuideController */
/* @var $model Guide */

$this->breadcrumbs=array(
	Yii::t('database','Guides')=>array('index'),
	$model->id_guide,
);

$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Guide'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Guide'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_guide),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Guide'), 'url'=>array('admin')),
);

if (Yii::app()->user->checkAccess('Administrador'))
    $label=" (".$model->idUser->idCompany->company_name.")";
    else
        $label="";

?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Guide')?> #<?php echo $model->num_guide.$label; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'id_guide',
            'num_guide',
               array(
                'name'=>'Ingresada por',
                'value'=>CHtml::link(
                        ' '.$model->idUser->user_names.' '.
                        ' '.$model->idUser->user_lastnames
                        ,array('users/viewClient','id'=>$model->id_user)),
                'type'=>'raw',
                'visible'=>Yii::app()->user->checkAccess('Administrador')
            ),
             array(
                'name'=>'date_guide_create',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->date_guide_create))
             ),
            array(
            'name'=>'Guia Adjunta',
            'type'=>'raw',
            'value'=> CHtml::link(CHtml::encode($model->pdf_guide), Yii::app()->baseUrl . '/images/guides/'.$model->id_guide."/". $model->pdf_guide, array('target'=>'_blank')),
            ),
	),
));
                    ?>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'weight-grid',
	'dataProvider'=>$weight->search(),
	
	'columns'=>array(
		'idProvider.provider_name',
                'idWeightType.weight_type_name',
                'amount_weight',
                'idWeightUnit.weight_unit_name',
	),
)); ?>

				