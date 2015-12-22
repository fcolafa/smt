<?php
/* @var $this GuideController */
/* @var $model Guide */

$this->breadcrumbs=array(
	Yii::t('database','Guides')=>array('view','id'=>$model->id_guide,),
	
);
if(!Yii::app()->user->checkAccess('Encargado Puerto')){
    $this->menu=array(
            array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Guide'), 'url'=>array('create')),
            array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Guide'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_guide),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
            array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Guide'), 'url'=>array('admin')),
    );
}
 $label="";
if (Yii::app()->user->checkAccess('Administrador'))
    $label=" (".$model->idUser->idCompany->company_name.")";
     $link2="";  
if(!empty($model->id_manifest))
   $link2="Manifiesto: ". CHtml::link(CHtml::encode($model->id_manifest), Yii::app()->baseUrl . '/manifest/'.$model->id_manifest, array('target'=>'_blank'));
    $creator="";
if(!empty($model->id_user_creator))
    $creator=CHtml::link(
                        ' '.$model->idUserc->user_names.' '.
                        ' '.$model->idUserc->user_lastnames
                        ,array('users/view','id'=>$model->id_user_creator));
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Guide')?> #<?php echo $model->num_guide.$label." ".$link2; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'id_guide',
            'num_guide',
                array(
                'name'=>'Usuario Asignado',
                'value'=>CHtml::link(
                        ' '.$model->idUser->user_names.' '.
                        ' '.$model->idUser->user_lastnames
                        ,array('users/viewClient','id'=>$model->id_user)),
                'type'=>'raw',
                'visible'=>Yii::app()->user->checkAccess('Administrador')
            ),
               array(
                'name'=>'Ingresada por',
                'value'=>$creator,
                'type'=>'raw',
                'visible'=>!empty($model->id_user_creator),
              
              
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
<h4> Carga :</h4>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'weight-grid',
	'dataProvider'=>$weight->search(),
	
	'columns'=>array(
		'weightprovider',
                'weighttype',
                'amount_weight',
                'idWeightUnit.weight_unit_name',
	),
)); ?>
<?php if(Yii::app()->user->checkAccess('Cliente')||
       Yii::app()->user->checkAccess('Administrador') ){ ?>
<h4> Seguimiento:</h4>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reception-grid',
	'dataProvider'=>$has->search(),
	
	'columns'=>array(
             array(
                'name'=>'idReception.reception_date',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>'Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($data->idReception->reception_date))',
             ),
            'idReception.idHeadquarter.headquarter_name',
            'idReception.idEmbarkation.embarkation_name',
            array(
                'name'=>'Recepcionado por',
                'value'=>'$data->idReception->idUser->user_names." ".$data->idReception->idUser->user_lastnames'
                ),
            ),
       )); }?>

				