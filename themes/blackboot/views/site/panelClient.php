<?php

$this->pageTitle=Yii::app()->name . ' -'.Yii::t('database','Servicios');
$this->breadcrumbs=array(
	'Servicios',
);
?>

<h1><?php echo  Yii::t('database','Servicios')?></h1>

<div class="dashboardIcons span-16">

     <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/users/viewClient/<?php echo Yii::app()->user->id;?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-person.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/users/viewClient/<?php echo Yii::app()->user->id;?>"><?php echo Yii::t ('database','Profile') ?></a></div>
    </div>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/guide/index?idu=<?php echo Yii::app()->user->id;?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-files.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/guide/index?idu=<?php echo Yii::app()->user->id;?>"><?php echo Yii::t ('database','Guides') ?></a></div>
    </div>
   <!--
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/headquarter/index?idu=<?php echo Yii::app()->user->id;?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-warehouse.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/headquarter/index?idu=<?php echo Yii::app()->user->id;?>"><?php echo Yii::t ('database','Headquarters') ?></a></div>
    </div>
   -->
    
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/ticket/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-write.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/ticket/admin"><?php echo Yii::t ('database','Tickets') ?></a></div>
    </div>
    
        
    
</div><!-- form -->

