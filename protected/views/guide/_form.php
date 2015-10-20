
<?php
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/addGuide.js');

?>
<script type='text/javascript'>
<?php
$providerid = json_encode(CHtml::listData(Provider::model()->findAll(), 'id_provider', 'provider_name'));
$units = json_encode(CHtml::listData(WeightUnit::model()->findAll(),'id_weight_unit', 'weight_unit_name'));
$typeweight = json_encode(CHtml::listData(WeightType::model()->findAll(),'id_weight_type', 'weight_type_name'));
echo "var providerid = ". $providerid . ";\n";
echo "var units = ". $units . ";\n";
echo "var typeweight = ". $typeweight . ";\n";
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

	<div class="row">
		<?php echo $form->labelEx($model,'num_guide'); ?>
		<?php echo $form->textField($model,'num_guide',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'num_guide'); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'pdf_guide'); ?>
		<?php echo CHtml::activeFileField($model,'pdf_guide'); ?>
		<?php echo $form->error($model,'pdf_guide'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'xml_guide'); ?>
		<?php echo CHtml::activeFileField($model,'xml_guide'); ?>
		<?php echo $form->error($model,'xml_guide'); ?>
	</div>
-->
        <br>
        
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