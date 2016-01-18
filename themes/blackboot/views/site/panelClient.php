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
    <?php if(Yii::app()->user->checkAccess('Cliente')):?>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/guide/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-files.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/guide/admin"><?php echo Yii::t ('database','Guides') ?></a></div>
    </div>
    <?php endif ?>
   <!--
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/headquarter/index?idu=<?php echo Yii::app()->user->id;?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-warehouse.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/headquarter/index?idu=<?php echo Yii::app()->user->id;?>"><?php echo Yii::t ('database','Headquarters') ?></a></div>
    </div>
   -->
   
    <?php if(Yii::app()->user->checkAccess('Encargado Puerto')||
            Yii::app()->user->checkAccess('Capitan')||
            Yii::app()->user->checkAccess('Jefe Centro')):?>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/reception/create"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-pencil.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/reception/create"><?php echo Yii::t ('database','Reception'). " ". Yii::t ('database','Guide') ?></a></div>
    </div>
    <?php endif ?>
   
    <?php if(Yii::app()->user->checkAccess('Cliente')
            ||Yii::app()->user->checkAccess('Administrador')
            ||Yii::app()->user->checkAccess('Administración & Finanzas')
            ||Yii::app()->user->checkAccess('Gerencia General')
            ||Yii::app()->user->checkAccess('Flota')):
        ?>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/ticket/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-write.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/ticket/admin"><?php echo Yii::t ('database','Tickets') ?></a></div>
    </div>
   
   
   <?php endif ?>
   
   <?php if( Yii::app()->user->checkAccess('Motorista')){ ?>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/schedule/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-gears.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/schedule/admin"><?php echo Yii::t ('database','Schedule') ?></a></div>
    </div>   
   <?php } ?>
   <?php if( Yii::app()->user->checkAccess('Capitan')){ ?>
    <div class="dashIcon">
        <a href="<?php echo Yii::app()->baseurl?>/bridge/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-gears.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/bridge/admin"><?php echo Yii::t ('database','Bridge') ?></a></div>
    </div>   
   <?php } ?>
    
</div><!-- form -->

