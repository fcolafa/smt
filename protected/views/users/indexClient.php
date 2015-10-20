<?php
/* @var $this UsersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
   
);

$this->menu=array(
	array('label'=>Yii::t('actions','Create')." ". Yii::t('database','Cliente'), 'url'=>array('createClient')),
	array('label'=>Yii::t('actions','Manage')." ". Yii::t('database','Client'), 'url'=>array('adminClient')),
);
?>

<h1> <?php echo Yii::t('database','Clients')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewClient',
)); ?>
