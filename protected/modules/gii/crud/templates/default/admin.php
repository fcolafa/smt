<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label="Yii::t('database','".$this->pluralize($this->class2name($this->modelClass))."')";
echo "\$this->breadcrumbs=array(
	Yii::t('database',$label)=>array('index'),
	Yii::t('actions','Manage'),
);\n";
?>

$this->menu=array(
array('label'=>Yii::t('actions','List')." ". <?php echo "Yii::t('database','".$this->modelClass."')"?>, 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ".<?php echo "Yii::t('database','".$this->modelClass."')"?>, 'url'=>array('create')),
);?>
<h1><?php echo "<?php echo Yii::t('actions','Manage')?>"?> <?php echo "<?php echo Yii::t('database','".$this->pluralize($this->class2name($this->modelClass))."')?>"?></h1>

<p>
<?php echo "<?php echo Yii::t('validation','You may optionally enter a comparison operator')?>"?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo "<?php echo Yii::t('validation','or')?>"?> <b>=</b>
) <?php echo "<?php echo Yii::t('validation','at the beginning of each of your search values to specify how the comparison should be done')?>"?> .
</p>
<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
