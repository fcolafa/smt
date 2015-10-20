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
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label="Yii::t('database','".$this->pluralize($this->class2name($this->modelClass))."')";
echo "\$this->breadcrumbs=array(
	$label=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	Yii::t('actions','Update'),
);\n";
?>

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ". <?php echo "Yii::t('database','".$this->modelClass."')"?>, 'url'=>array('index')),
	array('label'=>Yii::t('actions','Create')." ". <?php echo "Yii::t('database','".$this->modelClass."')"?>, 'url'=>array('create')),
	array('label'=>Yii::t('actions','View')." ". <?php echo "Yii::t('database','".$this->modelClass."')"?>, 'url'=>array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>Yii::t('actions','Manage')." ". <?php echo "Yii::t('database','".$this->modelClass."')"?>, 'url'=>array('admin')),
);
?>

<h1> <?php echo "<?php echo Yii::t('actions','Update')?>"?> <?php echo "<?php echo Yii::t('database','".$this->modelClass."')?> <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>