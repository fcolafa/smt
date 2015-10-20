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
	$label=>array('index'),
	Yii::t('actions','Create'),
);\n";
?>

$this->menu=array(
	array('label'=>Yii::t('actions','List')." ".<?php echo "Yii::t('database','".$this->modelClass."')"?>, 'url'=>array('index')),
	array('label'=>Yii::t('actions','Manage')." ". <?php echo "Yii::t('database','".$this->modelClass."')"?>, 'url'=>array('admin')),
);
?>

<h1><?php echo "<?php echo Yii::t('actions','Create')?>"?> <?php echo "<?php echo Yii::t('database','".$this->modelClass."')?>" ?></h1>

<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
