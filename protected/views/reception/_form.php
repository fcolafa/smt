<?php
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/addGuideReception.js');
  
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

 $(document).ready(function(e) {
        <?php 
        $cont=0;
        if($model->_guides){
           // echo "indexguide=".  count($model->_guides).";";
            foreach ($model->_guides as $item){
                $guide=  Guide::model()->findByPk($item);
                echo "window.onload=addRowItem();";
                echo " $('#guide'+".$cont.").append('<h5>'+ '".CHtml::link(CHtml::encode($guide->num_guide." (".$guide->idUser->idCompany->company_name.")"), array('guide/view','id'=>$guide->id_guide,), array('target'=>'_blank'))."'+'</h5>');";
                echo " indexguide = indexguide+1; ";
             
            $cont++;
            }
        }
     ?> 
     });
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reception-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>
        <div class="row" >
         <?php echo $form->labelEx($model,'_guide'); ?>
         <?php 
           
             if ($model->_guide&& $model->_guide!=0)
             {
                 $value=$model->guides->num_guide." (".$model->idUser->idCompany->company_name.")";
             }
             else {
                 $value='';
             }
             echo $form->hiddenField($model, '_guide' ,array());
             $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
             'name'=>'guidex',
             'id'=>'guidex',
             'model'=>$model,
             'value'=>'',
             'sourceUrl'=>$this->createUrl('listGuides'),
             'options'=>array(
             'minLength'=>'1',
             'showAnim'=>'fold',
             'search'=> 'js:function(event, ui)
                { jQuery("#Reception__guide").val(0); }',
             'select' => 'js:function(event, ui)
             {     
             var valid=true;
                $("#Reception__guides option").each(function(){
                    if($(this).attr("value")==ui.item["id"]){
                    alert("la guia "+ui.item["label"]+" ya ha sido tomada");
                    valid=false;
                            }
                        }
                    );
                    if(valid==false){
                        return false;
                        }
                    addRowItem();
                    $("#Reception__guides").append(new Option(ui.item["id"], ui.item["id"], true, true));
                    $("#guide"+indexguide).append("<h5>"+ ui.item["link"] +"</h5>");
                    indexguide = indexguide+1;              
              }',
                 'onload'=>' alert("ñe");',
             ),
             ));
         ?>
            <?php echo $form->error($model,'_guide'); ?>
	
        </div>
        
        <div class="row" >
            <table  class="item-class grid-view">
                <thead id="tblGuideHead">
                    <tr>
                      
                    </tr>
                </thead>
                <tbody id="tblguide">
                </tbody>           
            </table>
        </div>
        
        <div class="row" style="display: none">
		<?php echo $form->labelEx($model,'_guides'); ?>
		<?php echo $form->dropDownList($model,'_guides',$model->_guides ,array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'_guides'); ?>
	</div>
   
      
	<div class="row">
		<?php echo $form->labelEx($model,'id_headquarter'); ?>
		<?php echo $form->dropDownList($model,'id_headquarter', CHtml::listData(Headquarter::model()->findAll(array('order'=>'headquarter_name')),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Lugar asociado')); ?>
		<?php echo $form->error($model,'id_headquarter'); ?>
	</div>
     
        
        <?php if(Yii::app()->user->checkAccess('Capitan')){ ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'id_headquarter'); ?>
		<?php //echo $form->dropDownList($model,'id_headquarter', CHtml::listData(Headquarter::model()->findAll(),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Lugar asociado')); ?>
		<?php //echo $form->error($model,'id_headquarter'); ?>
	</div>
        <?php }?>
          <?php if(Yii::app()->user->checkAccess('Jefe Centro')){ ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'id_headquarter'); ?>
		<?php //echo $form->dropDownList($model,'id_headquarter', CHtml::listData(Headquarter::model()->findAll('headquarter_type="Centro de Cultivo"'),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Lugar asociado')); ?>
		<?php //echo $form->error($model,'id_headquarter'); ?>
	</div>
        <?php }?>
        
        <?php if(!Yii::app()->user->checkAccess(  'Encargado Puerto')){ ?>
      
	<div class="row">
		<?php echo $form->labelEx($model,'id_embarkation'); ?>
		<?php echo $form->dropDownList($model,'id_embarkation',  CHtml::listData(Embarkation::model()->findAll(array('order'=>'embarkation_name')), 'id_embarkation', 'embarkation_name'),array('prompt'=>'Seleccione nave asociada','prompt'=>'Ninguna nave asociada')); ?>
		<?php echo $form->error($model,'id_embarkation'); ?>
	</div>
        <?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Notify') : Yii::t('actions','Notify'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->