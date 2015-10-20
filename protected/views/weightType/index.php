<?php
/* @var $this WeightTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('database','Weight Types'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','WeightType'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','WeightType'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('database','Weight Types')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
