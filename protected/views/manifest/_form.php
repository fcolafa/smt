<?php
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/addGuideManifest.js');
  
?>
<script type='text/javascript'>

var name = "Manifest__guides";

 $(document).ready(function(e) {
     
        <?php 
        $cont=0;
        if($model->_guides){
           // echo "indexguide=".  count($model->_guides).";";
            foreach ($model->_guides as $item){
                   $conw=1;
                $guide=  Guide::model()->findByPk($item);
                echo "window.onload=addTableGuide();";
                echo " $('#guide'+".$cont.").append('<h5>Guia:'+ '".CHtml::link(CHtml::encode($guide->num_guide." (".$guide->idUser->idCompany->company_name.")"), array('guide/view','id'=>$guide->id_guide,), array('target'=>'_blank'))."'+'</h5>');";
              
                $criteria=new CDbCriteria();
                $criteria->condition="id_guide=".$guide->id_guide;
                $weights=  Weight::model()->findAll($criteria);
                
                    foreach($weights as $weight){
                    echo "window.onload=addWeigth(indexguide);";
                    echo "$('#we'+".$cont."+".$conw.").append('<h6>-'+'".$weight->weightprovider." '+'".$weight->weighttype."'+' '+".$weight->amount_left."+' ('+'".$weight->idWeightUnit->weight_unit_name."'+')'+'</h6>');"; 
                    echo "$('#we'+".$cont."+".$conw.").attr('class',".$weight->id_guide."+'-'+".$weight->id_weight.");";
                      $conw++;
                    }
                      echo "indexguide = indexguide+1;";
            $cont++;
            }
        }
     ?> 
     });
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manifest-form',	
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <?php echo Yii::t('validation','Fields with')?> <span class="required">*</span> <?php echo Yii::t('validation','are required')?> </p>

	<?php echo $form->errorSummary($model); ?>


      	<div class="row">
		<?php echo $form->labelEx($model,'id_embarkation'); ?>
		<?php echo $form->dropDownList($model,'id_embarkation',  CHtml::listData(Embarkation::model()->findAll(array('order'=>'embarkation_name')), 'id_embarkation', 'embarkation_name'),array('prompt'=>'Seleccione nave asociada','prompt'=>'Ninguna nave asociada')); ?>
		<?php echo $form->error($model,'id_embarkation'); ?>
	</div>

        <div class="row">
                <?php echo $form->labelEx($model,'manifest_charge_date'); ?>
                <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker',array(
                'model'=>$model, //Model object
                'attribute'=>'manifest_charge_date', //attribute name
                       'mode'=>'datetime', //use "time","date" or "datetime" (default)
                'options'=>array(
                    'dateFormat'=>'dd-mm-yy',
                    'maxDate' => 'today',
                ), // jquery plugin options
            ));?>
                 <?php echo $form->error($model,'manifest_charge_date'); ?>
        </div>
	

        <div class="row">
		<?php echo $form->labelEx($model,'id_headquarter'); ?>
		<?php echo $form->dropDownList($model,'id_headquarter', CHtml::listData(Headquarter::model()->findAll('headquarter_type="Centro de Cultivo"'),'id_headquarter','headquarter_name'),array('prompt'=>'Seleccione Lugar asociado')); ?>
		<?php echo $form->error($model,'id_headquarter'); ?>
	</div>   

	
        	
        
        <div class="row">
                <?php echo $form->labelEx($model,'manifest_sailing'); ?>
                <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker',array(
                'model'=>$model, //Model object
                'attribute'=>'manifest_sailing', //attribute name
                       'mode'=>'datetime', //use "time","date" or "datetime" (default)
                'options'=>array(
                    'dateFormat'=>'dd-mm-yy',
                    'maxDate' => 'today',
                ), // jquery plugin options
            ));?>
                 <?php echo $form->error($model,'manifest_sailing'); ?>
        </div>
        <div class="row">
                <?php echo $form->labelEx($model,'manifest_return'); ?>
                <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker',array(
                'model'=>$model, //Model object
                'attribute'=>'manifest_return', //attribute name
                       'mode'=>'datetime', //use "time","date" or "datetime" (default)
                'options'=>array(
                    'dateFormat'=>'dd-mm-yy',
                    'maxDate' => 'today',
                ), // jquery plugin options
            ));?>
                 <?php echo $form->error($model,'manifest_return'); ?>
        </div>
        
          <div class="row" style="display: none">
      
		<?php echo $form->labelEx($model,'_guides'); ?>
		<?php echo $form->dropDownList($model,'_guides',$model->_guides ,array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'_guides'); ?>
	</div>
         <div class="row" style="display: none">
          
		<?php echo $form->labelEx($model,'_weights'); ?>
		<?php echo $form->dropDownList($model,'_weights',$model->_weights ,array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'_weights'); ?>
            </div>

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
                   
                $("#Manifest__guides option").each(function(){
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
                          $("#we"+indexguide+ist).append("<h6>-"+ arr[j]["weightprovider"]+" "+arr[j]["weighttype"]+" "+arr[j]["amount_left"]+" ("+arr[j]["unit"]+")"+"</h6>");
                          $("#we"+indexguide+ist).attr("class",item);  
                    }
            
                    $("#Manifest__guides").append(new Option(ui.item["id"], ui.item["id"], true, true));
                    $("#guide"+indexguide).append("<h5>"+ ui.item["link"] +"</h5>");
                    indexguide = indexguide+1;              
              }',
                
             ),
             ));
         ?>
            <?php echo $form->error($model,'_guide'); ?>
	 <note>(escriba un indicio del número de la guia para la busqueda automatica)</note>
        </div>
        
        <div class="row" >
            <table  class="">
                <thead id="tblGuideHead">
                    <tr>
                      
                    </tr>
                </thead>
                <tbody id="tblguide">

                </tbody>           
            </table>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'manifest_observation'); ?>
		<?php echo $form->textArea($model,'manifest_observation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'manifest_observation'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->