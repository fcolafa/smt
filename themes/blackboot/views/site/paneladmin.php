<?php

$this->pageTitle=Yii::app()->name . ' -'.Yii::t('database','Panel Administración');
$this->breadcrumbs=array(
	'Panel Aministración',
);
?>

<h1><?php echo  Yii::t('database','Panel de administración')?></h1>

<div class="dashboardIcons span-16">

    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/users/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-people.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/users/admin"><?php echo Yii::t ('database','Users') ?></a></div>
    </div>
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/guide/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-filesblue.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/guide/admin"><?php echo Yii::t ('database','Guides') ?></a></div>
    </div>
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/manifest/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-filesblue.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/manifest/admin"><?php echo Yii::t ('database','Manifests') ?></a></div>
    </div>
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/embarkation/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-ship-blue.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/embarkation/admin"><?php echo Yii::t ('database','Embarkations') ?></a></div>
    </div>
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/headquarter/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-fishfarm-blue.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/headquarter/admin"><?php echo Yii::t ('database','Headquarters') ?></a></div>
    </div>
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/weightUnit/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-cash2-blue.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/weightUnit/index"><?php echo Yii::t ('database','Weight Units') ?></a></div>
    </div>
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/company/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-building-blue.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/company/admin"><?php echo Yii::t ('database','Companies') ?></a></div>
    </div>
<!--    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/weighttype/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-weight_type.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/weighttype/index"><?php echo Yii::t ('database','Weight Types') ?></a></div>
    </div>-->
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/ticket/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-write.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/ticket/admin"><?php echo Yii::t ('database','Tickets') ?></a></div>
    </div>   
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/schedule/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-gears.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/schedule/admin"><?php echo Yii::t ('database','Schedule') ?></a></div>
    </div>   
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/bridge/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-gears.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/bridge/admin"><?php echo Yii::t ('database','Bridge') ?></a></div>
    </div>   
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/reports/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-chart.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/reports/index"><?php echo Yii::t ('database','Reports') ?></a></div>
    </div>   
    
</div><!-- form -->

