
<?php
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/addGuide.js');

?>
<script type='text/javascript'>
    var company=0;
<?php
$providerid = json_encode(CHtml::listData(Provider::model()->findAll(), 'id_provider', 'provider_name'));
$units = json_encode(CHtml::listData(WeightUnit::model()->findAll(),'id_weight_unit', 'weight_unit_name'));
$typeweight = json_encode(CHtml::listData(WeightType::model()->findAll(),'id_weight_type', 'weight_type_name'));
$guides = json_encode(CHtml::listData(Guide::model()->findAll(),'num_guide', 'idUser.id_company'));

echo "var providerid = ". $providerid . ";\n";
echo "var units = ". $units . ";\n";
echo "var typeweight = ". $typeweight . ";\n";
echo "var guides = ". $guides . ";\n";
if (!Yii::app()->user->checkAccess('Administrador')){
    $user=  Users::model()->findByPk(Yii::app()->user->Id);
    echo "company='".$user->id_company."';";
}

?>
var newguide='<?php echo $model->isNewRecord ? 'newguide' : $model->id_guide  ?>';  
var urladdress='<?php echo Yii::app()->createAbsoluteUrl("Guide/addWeigth"); ?>';
 $(document).ready(function(e) {
        <?php 
        $cont=0;
        if(!$model->isNewRecord){
            foreach ($weight as $item){
                echo "window.onload=addRowItem();";
                echo "document.getElementById('provider".$cont."').value='".$item->id_provider."';";
                echo "document.getElementById('wtype".$cont."').value='".$item->id_weight_type."';";
                echo "document.getElementById('amount".$cont."').value='".$item->amount_weight."';";
                echo "document.getElementById('unit".$cont."').value='".$item->id_weight_unit."';";
            $cont++;
            }
        }
     ?> 
     });
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guide-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'form-horizontal'),
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>

        <?php if(Yii::app()->user->checkAccess('Administrador')){?>
        
          <div class="row"> 
         <?php echo $form->labelEx($model,'id_user'); ?>
         <?php 
           
             if ($model->id_user&& $model->id_user!=0)
             {
                 $value=$model->idUser->user_names." ".$model->idUser->user_lastnames." (".$model->idUser->idCompany->company_name;
             }
             else {
                 $value='';
             }
             echo $form->hiddenField($model, 'id_user' ,array());
             $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
             'name'=>'user_name',
             'model'=>$model,
             'value'=>$value,
             'sourceUrl'=>$this->createUrl('listUser'),
             'options'=>array(
             'minLength'=>'1',
             'showAnim'=>'fold',
             'select' => 'js:function(event, ui)
             { jQuery("#Guide_id_user").val(ui.item["id"]); 
              company=(ui.item["comp"]); 
             
             }',
             'search'=> 'js:function(event, ui)
             { jQuery("#Guide_id_user").val(0); }'
             ),
             ));
         ?>
            <?php echo $form->error($model,'id_user'); ?>
	</div>
    
        <?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'num_guide'); ?>
		<?php echo $form->textField($model,'num_guide',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'num_guide'); ?>
	</div>
	<div class="row" style="display:none;">
		<?php echo $form->labelEx($model,'pdf_guide'); ?>
		<?php echo $form->textField($model,'pdf_guide'); ?>
		<?php echo $form->error($model,'pdf_guide'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'id_headquarter'); ?>
		<?php echo $form->dropDownList($model,'id_headquarter', CHtml::listData(Headquarter::model()->findAll(array('order'=>'headquarter_name')),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Origen asociado')); ?>
		<?php echo $form->error($model,'id_headquarter'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'id_destination'); ?>
		<?php echo $form->dropDownList($model,'id_destination', CHtml::listData(Headquarter::model()->findAll(array('order'=>'headquarter_name')),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Destino asociado')); ?>
		<?php echo $form->error($model,'id_destination'); ?>
	</div>
        <div class="row">
        	<?php echo $form->labelEx($model,'guide_weight_type'); ?>
		<?php echo $form->dropDownList($model,'guide_weight_type',array('prompt'=>'Seleccione tipo de carga','Carga general'=>'Carga general','Alimento'=>'Alimento')); ?>
		<?php echo $form->error($model,'guide_weight_type'); ?>
	</div>
	
        
        <br>
            <div class="row">
            <label></label>
        <?php 

        $this->widget('ext.EFineUploader.EFineUploader',
         array(
               'id'=>'FineUploader',
               'config'=>array(
                   'autoUpload'=>true,
                   'multiple'=> true,
                   
                  
        
                               'request'=>array(
                                  'endpoint'=>'upload',// OR $this->createUrl('files/upload'),
                                  'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                               ),
                               'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                               'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                               'callbacks'=>array(
                                                //'onComplete'=>"js:function(id, name, response){ $('li.qq-upload-success').remove(); }",
                                                //'onError'=>"js:function(id, name, errorReason){ }",
                                                 ),
                               'validation'=>array(
                                         'allowedExtensions'=>array('pdf'),
                                         'sizeLimit'=>5 * 1024 * 1024,//maximum file size in bytes
                                       //  'minSizeLimit'=>0*1024*1024,// minimum file size in bytes
                                                  ),
                   'callbacks'=>array(
          'onComplete'=>"js:function(id, name, response){
              if(response.filename!=null)
             $('#Guide_pdf_guide').val(response.filename);
             
           }",
           'onError'=>"js:function(id, name, errorReason){ }",
          'onValidateBatch' => "js:function(fileOrBlobData) {}", // because of crash
        ),
                              )
              ));

        ?>
        
        <div class="row">
        <p>
        <input id="btn" type="button" value="Añadir Carga" onclick="addRowItem();"   </p>
        <br>
        <br>
<!--   <input type="button" value="Agregar columna" id="btnAgregarColumna">-->
            </p>

        <div class="row">
            <table  class="item-class grid-view">
                <thead id="tblWeightHead">
                    <tr>
                        <td><?php echo Yii::t('database','Provider');?></td>
                        <td><?php echo Yii::t('database','Type Weight');?></td>
                        <td><?php echo Yii::t('database','Amount Weight');?></td>
                        <td><?php echo Yii::t('database','Weight Unit');?></td>
                    </tr>
                </thead>
                <tbody id="tblWeight">
                </tbody>           
            </table>
        </div>

        </div>
         <div class="row">
        <p>
        <input  type="button" value="Guardar Guia" onclick="saveGuide();" />
        </p>
         </div>
<?php 

$this->endWidget(); ?>

</div><!-- form -->