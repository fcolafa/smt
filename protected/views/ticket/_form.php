<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_embarkation'); ?>
		<?php echo $form->dropDownList($model,'id_embarkation',  CHtml::listData(Embarkation::model()->findAll(), 'id_embarkation', 'embarkation_name'),array('prompt'=>'Seleccione Nave Asociada')); ?>
		<?php echo $form->error($model,'id_embarkation'); ?>
	</div>
        
      
        
        <div class="row"> 
         <?php echo $form->labelEx($model,'id_headquarter'); ?>
         <?php
           
             if ($model->id_headquarter&& $model->id_headquarter!=0)
             {
                 $value=$model->idHeadquarter->headquarter_name;
             }
             else {
                 $value='';
             }
             echo $form->hiddenField($model, 'id_headquarter' ,array());
             $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
             'name'=>'headquarter_name',
             'model'=>$model,
             'value'=>$value,
             'sourceUrl'=>$this->createUrl('listHeadquarter'),
             'options'=>array(
             'minLength'=>'2',
             'showAnim'=>'fold',
             'select' => 'js:function(event, ui)
             { jQuery("#Ticket_id_headquarter").val(ui.item["id"]); }',
             'search'=> 'js:function(event, ui)
             { jQuery("#Ticket_id_headquarter").val(0); }'
             ),
             ));
         ?>
            <?php echo $form->error($model,'id_headquarter'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'ticket_subject'); ?>
		<?php echo $form->textField($model,'ticket_subject',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ticket_subject'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'id_classification'); ?>
		<?php echo $form->dropDownList($model,'id_classification',  CHtml::listData(Classification::model()->findAll(), 'id_classification', 'classification_name'),array('prompt'=>'Seleccione Categoria')); ?>
		<?php echo $form->error($model,'id_classification'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'ticket_description'); ?>
		<?php echo $form->textArea($model,'ticket_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ticket_description'); ?>
	</div>
        <div class="row" style="display:none;">
		<?php echo $form->labelEx($model,'ticket_file'); ?>
		<?php echo $form->telField($model,'ticket_file'); ?>
		<?php echo $form->error($model,'ticket_file'); ?>
	</div>
        
        
        
        <div class="row">
            <label></label>
        <?php 

        $this->widget('ext.EFineUploader.EFineUploader',
         array(
               'id'=>'FineUploader',
               'config'=>array(
                               'autoUpload'=>true,
                               'request'=>array(
                                  'endpoint'=>'upload',// OR $this->createUrl('files/upload'),
                                  'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                               ),
                               'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                               'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                               'callbacks'=>array(
                                               // 'onComplete'=>"js:function(id, name, response){ alert('ñe'); }",
                                                //'onError'=>"js:function(id, name, errorReason){ }",
                                                 ),
                               'validation'=>array(
                                         'allowedExtensions'=>array('pdf','jpg','jpeg','png','txt','docs','docxs','xls','xlsx','gif','ppt','pptx'),
                                         'sizeLimit'=>5 * 1024 * 1024,//maximum file size in bytes
                                       //  'minSizeLimit'=>0*1024*1024,// minimum file size in bytes
                                                  ),
                   'callbacks'=>array(
          'onComplete'=>"js:function(id, name, response){
             $('#efine_name').text(response.filename);
             $('#Ticket_ticket_file').val(response.filename);
           }",
           'onError'=>"js:function(id, name, errorReason){ }",
          'onValidateBatch' => "js:function(fileOrBlobData) {}", // because of crash
        ),
                              )
              ));

        ?>
        </div>
        
        <div class="row">
		   <?php echo $form->labelEx($model,'ticket_date_incident'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'ticket_date_incident', //attribute name
               'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'dd-mm-yy',
            'maxDate' => 'today',
        ), // jquery plugin options
    ));
        
?>
     <?php echo $form->error($model,'ticket_date_incident'); ?>
	</div>
        
         <div class="row">
            <label></label>
            
            <?php $this->widget('CCaptcha'); ?>
        </div>

        <div class="row">
                <?php echo $form->labelEx($model,'_verifyCode'); ?>
               <?php echo $form->textField($model,'_verifyCode'); ?>
               <?php echo $form->error($model,'_verifyCode'); ?>
        </div>
      
	
    
		
	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->