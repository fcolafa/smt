<?php
/* @var $this TicketMessageController */
/* @var $model TicketMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($ticketm); ?>
   

        
        <div class="row"> 
         <?php echo $form->labelEx($ticketm,'id_user_asigned'); ?>
         <?php
           
             if ($ticketm->id_user_asigned&& $ticketm->id_user_asigned!=0)
             {
                 $value=($ticketm->idUsera->user_names." ".$ticketm->idUsera->user_lastnames."(".$ticketm->idUsera->user_name.")");
             }
             else {
                 $value=null;
             }
             echo $form->hiddenField($ticketm, 'id_user_asigned' ,array());
             $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
             'name'=>'id_user_asigned',
             'model'=>$ticketm,
             'value'=>$value,
             'sourceUrl'=>$this->createUrl('listUser'),
             'options'=>array(
             'minLength'=>'2',
             'showAnim'=>'fold',
             'select' => 'js:function(event, ui)
             { jQuery("#TicketMessage_id_user_asigned").val(ui.item["id"]); }',
             'search'=> 'js:function(event, ui)
             { jQuery("#TicketMessage_id_user_asigned").val(0); }'
             ),
             ));
         ?>
            <?php echo $form->error($ticketm,'id_user_asigned'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($ticketm,'ticket_message'); ?>
		<?php echo $form->textArea($ticketm,'ticket_message'); ?>
		<?php echo $form->error($ticketm,'ticket_message'); ?>
	</div>
        <div class="row" style="display:none;">
		<?php echo $form->labelEx($ticketm,'ticket_message_file'); ?>
		<?php echo $form->textField($ticketm,'ticket_message_file'); ?>
		<?php echo $form->error($ticketm,'ticket_message_file'); ?>
	</div>
        
        <div class="row">
            <label></label>
            
            <?php $this->widget('CCaptcha'); ?>
        </div>
         <div class="row">
                <?php echo $form->labelEx($ticketm,'_verifyCode'); ?>
               <?php echo $form->textField($ticketm,'_verifyCode'); ?>
               <?php echo $form->error($ticketm,'_verifyCode'); ?>
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
                                         'sizeLimit'=>1 * 1024 * 1024,//maximum file size in bytes
                                       //  'minSizeLimit'=>0*1024*1024,// minimum file size in bytes
                                                  ),
                   'callbacks'=>array(
          'onComplete'=>"js:function(id, name, response){
             $('#efine_name').text(response.filename);
             $('#TicketMessage_ticket_message_file').val(response.filename);
           }",
           //'onError'=>"js:function(id, name, errorReason){ }",
          'onValidateBatch' => "js:function(fileOrBlobData) {}", // because of crash
        ),
                              )
              ));

        ?>
        </div>
       
	<div class="row buttons">
		<?php echo CHtml::submitButton($ticketm->isNewRecord ? Yii::t('actions','Send') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->