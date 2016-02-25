<?php
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/addGuideReception.js');
  
?>

<script type='text/javascript'>
     


 $(document).ready(function(e) {
        <?php 
       
        $cont=0;
       
        if($model->_guides){
            foreach ($model->_guides as $item){
                 
                $conw=1;
                $guide=  Guide::model()->findByPk($item);
                echo "window.onload= addTableGuide();";
                if($weight)
                    foreach($weight as $w)
                        if($item==$w->id_guide){
                            echo "window.onload=addWeigth(indexguide);";                        
                            echo "$('#we'+".$cont."+".$conw.").append('<h5>'+'".$w->weightprovider." '+'".$w->weighttype."'+' '+".$w->amount_left."+' ('+'".$w->idWeightUnit->weight_unit_name."'+')'+'</h5>');"; 
                            echo "$('#we'+".$cont."+".$conw.").attr('class',".$w->id_guide."+'-'+".$w->id_weight.");";
                            if($model->_newAmount)
                               foreach($model->_newAmount as $na){
                                    $valna=explode('-',$na);                                   
                                    if($w->id_weight==$valna[1]){
       
                                        echo "$('#namount'+".$cont."+".$conw.").val(".$valna[2].");";
                                        echo "$('#check'+".$cont."+".$conw.").prop('checked', true);";
                                       
                                    }
                                } 
                            $conw++;
                }
                echo "indexguide = indexguide+1;";
                echo " $('#gui'+".$cont.").append('<h5>'+ '".CHtml::link(CHtml::encode($guide->num_guide." (".$guide->idUser->idCompany->company_name.")"), array('guide/view','id'=>$guide->id_guide,), array('target'=>'_blank'))."'+'</h5>');";
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
             var ist=0;   
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
      
                    addTableGuide();
                 
                     for(var j in arr=ui.item["guides"]){ 
                        var item=arr[j]["id_guide"]+"-"+arr[j]["id_weight"];
                       $("#Reception__weights").append(new Option(item,item, true, true));
                        addWeigth(indexguide);
                        ist=parseInt(j)+1;
                          $("#we"+indexguide+ist).append("<h5>"+ arr[j]["weightprovider"]+" "+arr[j]["weighttype"]+" "+arr[j]["amount_left"]+" ("+arr[j]["unit"]+")"+"</h5>");
                          $("#we"+indexguide+ist).attr("class",item);  
                    }
                    $("#Reception__guides").append(new Option(ui.item["id"], ui.item["id"], true, true));
                    
                    $("#gui"+indexguide).append("<h5>"+ ui.item["link"] +"</h5>");
                    indexguide = indexguide+1;    
                   
              }',
                 
             ),
             ));
         ?>
            <?php echo $form->error($model,'_guide'); ?>
	
        </div>
         <!--
        <div class="row" >
            <table  class="table-bordered">
                <thead id="tblGuideHead">
                    <tr>
                      
                    </tr>
                </thead>
                <tbody id="tblguide">
                </tbody>           
            </table>
        </div>
         -->
          <div class="row" >
            <table  class="table-bordered">
                <thead id="tblGuideHead2">
                    <tr>
                      
                    </tr>
                </thead>
                <tbody id="tbl_guide">
                </tbody>           
            </table>
        </div>
       
        <<div class="row" style="display: none">
		<?php echo $form->labelEx($model,'_guides'); ?>
		<?php echo $form->dropDownList($model,'_guides',$model->_guides ,array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'_guides'); ?>
	</div>
            <div class="row" style="display: none">
		<?php echo $form->labelEx($model,'_weights'); ?>
		<?php echo $form->dropDownList($model,'_weights',$model->_weights ,array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'_weights'); ?>
            </div>
     
        <div class="row" style="display: none">
		<?php echo $form->labelEx($model,'_newAmount'); ?>
		<?php echo $form->dropDownList($model,'_newAmount',$model->_newAmount ,array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'_newAmount'); ?>
	</div>
       
	

        <?php if(Yii::app()->user->checkAccess('Capitan')||Yii::app()->user->checkAccess(  'Encargado Puerto')){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_headquarter'); ?>
		<?php echo $form->dropDownList($model,'id_headquarter', CHtml::listData(Headquarter::model()->findAll('headquarter_type="Muelle/Puerto"'),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Lugar asociado')); ?>
		<?php echo $form->error($model,'id_headquarter'); ?>
	</div>   
	<div class="row">
		<?php echo $form->labelEx($model,'id_embarkation'); ?>
		<?php echo $form->dropDownList($model,'id_embarkation',  CHtml::listData(Embarkation::model()->findAll(array('order'=>'embarkation_name')), 'id_embarkation', 'embarkation_name'),array('prompt'=>'Seleccione nave asociada','prompt'=>'Ninguna nave asociada')); ?>
		<?php echo $form->error($model,'id_embarkation'); ?>
	</div>
        <?php }else if(Yii::app()->user->checkAccess('Jefe Centro')){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_headquarter'); ?>
		<?php echo $form->dropDownList($model,'id_headquarter', CHtml::listData(Headquarter::model()->findAll('headquarter_type="Centro de Cultivo"'),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Lugar asociado')); ?>
		<?php echo $form->error($model,'id_headquarter'); ?>
	</div>
        <?php }else if(Yii::app()->user->checkAccess('Jefe Centro')){?>
            <div class="row">
		<?php //echo $form->labelEx($model,'id_headquarter'); ?>
		<?php //echo $form->dropDownList($model,'id_headquarter', CHtml::listData(Headquarter::model()->findAll(array('order'=>'headquarter_name')),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Lugar asociado')); ?>
		<?php //echo $form->error($model,'id_headquarter'); ?>
	</div>
        <?php } ?>   
      
        <div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Notify') : Yii::t('actions','Notify'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->