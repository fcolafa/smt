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
	'id'=>'manifest-form',	
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
                    addRowItem();
                    $("#Manifest__guides").append(new Option(ui.item["id"], ui.item["id"], true, true));
                    $("#guide"+indexguide).append("<h5>"+ ui.item["link"] +"</h5>");
                    indexguide = indexguide+1;              
              }',
                
             ),
             ));
         ?>
            <?php echo $form->error($model,'_guide'); ?>
	
        </div>
        
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
        
        <div class="row" style="display: none"> <!--style="display: none"-->
		<?php echo $form->labelEx($model,'_guides'); ?>
		<?php echo $form->dropDownList($model,'_guides',$model->_guides ,array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'_guides'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions','Create') : Yii::t('actions','Save'),array('class'=>Yii::app()->params['btnclass'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->