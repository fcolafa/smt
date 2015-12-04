<?php
/* @var $this ReceptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('database','Receptions'),
);

$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Reception'), 'url'=>array('create')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Reception'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('database','Receptions')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
