<?php
/* @var $this WeightUnitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('database','Weight Units'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','WeightUnit'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','WeightUnit'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('database','Weight Units')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
