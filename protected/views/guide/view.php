<?php
/* @var $this GuideController */
/* @var $model Guide */

$this->breadcrumbs=array(
	Yii::t('database','Guides')=>array('index','idu'=>$idu),
	$model->id_guide,
);

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". Yii::t('database','Guide'), 'url'=>array('index','idu'=>$idu)),
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Guide'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Update')." ". Yii::t('database','Guide'), 'url'=>array('update', 'id'=>$model->id_guide, 'idu'=>$idu)),
	array('label'=>Yii::t('actions','Delete')." ". Yii::t('database','Guide'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_guide),'confirm'=>Yii::t('validation','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Guide'), 'url'=>array('admin', 'idu'=>$idu)),
);
?>

<h1><?php echo Yii::t('actions','View')?> <?php echo Yii::t('database','Guide')?> #<?php echo $model->id_guide; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'id_guide',
            'num_guide',
              array(
                'name'=>'date_guide_create',
                //'value'=>'date("d M Y",strtotime($data["work_date"]))'
                'value'=>Yii::app()->dateFormatter->format("d MMMM y | HH:mm:ss",strtotime($model->date_guide_create))
                ),
            array(
            'label'=>'pdf_guide',
            'type'=>'raw',
            'value'=> CHtml::link(CHtml::encode($model->pdf_guide), Yii::app()->baseUrl . '/images/guides/' . $model->pdf_guide),
            ),
	),
));
                    ?>


<?php 

$this->widget('ext.EFineUploader.EFineUploader',
 array(
       'id'=>'FineUploader',
       'config'=>array(
                       'autoUpload'=>true,
                       'request'=>array(
                          'endpoint'=>'upload?id='.$model->id_guide,// OR $this->createUrl('files/upload'),
                          'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                       ),
                       'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                       'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                       'callbacks'=>array(
                                        //'onComplete'=>"js:function(id, name, response){  }",
                                        //'onError'=>"js:function(id, name, errorReason){ }",
                                         ),
                       'validation'=>array(
                                 'allowedExtensions'=>array('pdf','jpg','PDF','JPEG','JPG','jpeg','png','PNG'),
                                 'sizeLimit'=>1 * 1024 * 1024,//maximum file size in bytes
                               //  'minSizeLimit'=>0*1024*1024,// minimum file size in bytes
                                          ),
           'callbacks'=>array(
  'onComplete'=>"js:function(id, name, response){
      location.reload();// for test purpose
     alert('El archivo se adjunto correctamente');
     $('#efine_name').text(response.filename);
   }",
   //'onError'=>"js:function(id, name, errorReason){ }",
  'onValidateBatch' => "js:function(fileOrBlobData) {}", // because of crash
),
                      )
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

				