<?php
/* @var $this ReceptionController */
/* @var $model Reception */

$this->breadcrumbs=array(
	
	Yii::t('actions','Create'),
);

$this->menu=array(
	
	array('label'=>Yii::t('actions','Notify')." ". Yii::t('database','Reception'), 'url'=>array('Create')),
);
?>

<h1><?php echo Yii::t('actions','Notify')?> <?php echo Yii::t('database','Reception')?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'weight'=>$weight)); ?>