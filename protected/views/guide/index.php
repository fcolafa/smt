<?php
/* @var $this GuideController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('database','Guides'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Guide'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Guide'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('database','Guides')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
