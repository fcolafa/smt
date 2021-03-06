<?php

$this->pageTitle=Yii::app()->name . ' -'.Yii::t('database','Panel Administración');
$this->breadcrumbs=array(
	'Panel Aministración',
);
?>

<h1><?php echo  Yii::t('database','Panel de administración')?></h1>

<div class="dashboardIcons span-16">
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/embarkation/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-ship.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/embarkation/index"><?php echo Yii::t ('database','Embarkations') ?></a></div>
    </div>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/provider/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-truck2.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/embarkation/index"><?php echo Yii::t ('database','Providers') ?></a></div>
    </div>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/weightUnit/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-cash2.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/weightUnit/index"><?php echo Yii::t ('database','Weight Units') ?></a></div>
    </div>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/company/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-building.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/company/index"><?php echo Yii::t ('database','Companies') ?></a></div>
    </div>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/weighttype/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-weight_type.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/weighttype/index"><?php echo Yii::t ('database','Weight Types') ?></a></div>
    </div>
    
        
    
</div><!-- form -->

