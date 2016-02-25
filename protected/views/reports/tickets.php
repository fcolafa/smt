<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/reports.js');
?>
<div class="form">
<h1><?php echo Yii::t('database', 'Reports'); ?></h1>

<?php
/* @var $this ReportsController */

$this->breadcrumbs=array(
	Yii::t('database', 'Reports'),
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tickets-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
       
)); ?>
<?php echo $form->errorSummary($model); ?>
<div class="row">
   
    <?php echo $form->labelEx($model,'_year'); ?>
    <?php echo $form->dropDownList($model,'_year',  $model->years()    ,array('prompt'=>'Seleccione Año','submit'=>array('tickets')));?>
    <?php echo $form->error($model,'_year'); ?>     
    </div>
<div class="dashboardIcons span-3">

    <div class="dashIcon">
        <?php
        $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
            'data' => $datachar,
            'options' => array('title' =>'% No Conformidades por empresa Año '.$model->_year)));
        ?>
    </div>
    <div class="dashIcon">
        <?php
        $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
            'data' => $datachar2,
            'options' => array('title' =>'% No Conformidades por centro Año '.$model->_year)));
        ?>
    </div>
    <div class="dashIcon">
            <?php
        $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
            'data' => $datachar3,
            'options' => array('title' =>'% No Conformidades por categoria Año '.$model->_year)));
        ?> </div>
    <div class="dashIcon">
            <?php
        $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
            'data' => $datachar4,
            'options' => array('title' =>'% Respondida Fuera y Dentro de plazo '.$model->_year)));
         ?> </div>
    <div class="dashIcon">
        <?php
        $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'LineChart',
            'data' => $datalinechar,
            'options' => array(
                'title' => 'Tiempo medio Respuesta y Cierre No Conformidad',
                'titleTextStyle' => array('color' => '#FF0000'),
                'vAxis' => array(
                    'title' => 'Dias',
                    'gridlines' => array(
                        'color' => 'transparent'  //set grid line transparent
                    )),
                'hAxis' => array('title' => 'Meses'),
                'curveType' => 'function', //smooth curve or not
                'legend' => array('position' => 'bottom'),
        )));
       
 
 ?>
    </div>
    </div>
<div class="row">
  <?php echo $form->labelEx($model,'_type'); ?>
  <?php echo $form->dropDownList($model,'_type',  $model->types()    ,array('prompt'=>'Seleccione Tipo de Reporte'));?>
  <?php echo $form->error($model,'_type'); ?>  
</div>
<div class="row" id="frame">
       <?php echo $form->labelEx($model,'_initdate'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'_initdate', //attribute name
               'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'dd-mm-yy',
            'maxDate' => 'today',
        ), // jquery plugin options
    ));
        
?>
     <?php echo $form->error($model,'_initdate'); ?>
        <?php echo $form->labelEx($model,'_endate'); ?>
        <?php $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'_endate', //attribute name
                'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'dd-mm-yy',
            'maxDate' => 'today',
        ), // jquery plugin options
    ));
?><?php echo $form->error($model,'_endate'); ?>

</div>


<div class="row" id="range">
   
    <?php echo $form->labelEx($model,'_range'); ?>
    <?php echo $form->dropDownList($model,'_range',  $model->years()    ,array('multiple'=>'multiple'));?>
    <?php echo $form->error($model,'_range'); ?>     
    </div>
<br>
  <div class="">
            <label></label>
            
            <?php $this->widget('CCaptcha'); ?>
        </div>
      

        <div class="row">
               <?php echo $form->labelEx($model,'_verifyCode'); ?>
               <?php echo $form->textField($model,'_verifyCode'); ?>
               <?php echo $form->error($model,'_verifyCode'); ?>
        </div>
	    <div class="row buttons" >
		<?php echo CHtml::submitButton(Yii::t('actions','Generate')." ".Yii::t('actions','Excel')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->