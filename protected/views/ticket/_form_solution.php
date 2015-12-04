<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-solution-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ticket_solution'); ?>
		<?php echo $form->textArea($model,'ticket_solution',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ticket_solution'); ?>
	</div>
       
       
        
          <div class="row" >
		<?php echo $form->labelEx($model,'_solution_files'); ?>
		<?php echo $form->dropDownList($model,'_solution_files',$model->_solution_files ,array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'_solution_files'); ?>
	</div>
       
        <div class="row">
            <label></label>
        <?php 

        $this->widget('ext.EFineUploader.EFineUploader',
         array(
               'id'=>'solution',
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
                                        'allowedExtensions'=>array('pdf','jpg','jpeg','png','txt','rtf','doc','docx','xls','xlsx','gif','ppt','pptx'),
                                         'sizeLimit'=>5 * 1024 * 1024,//maximum file size in bytes
                                       //'minSizeLimit'=>0*1024*1024,// minimum file size in bytes
                                                  ),
                   'callbacks'=>array(
          'onComplete'=>"js:function(id, name, response){
              
            if(response.filename!=null)
           $('#Ticket__solution_files').append(new Option(response.filename, response.filename, true, true));
           }",
           //'onError'=>"js:function(id, name, errorReason){ }",
          'onValidateBatch' => "js:function(fileOrBlobData) {}", // because of crash
        ),
                              )
              ));

        ?>
        </div>
        <br>
        
        
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
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Send') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->