<?php
/* @var $this ReportsController */

$this->breadcrumbs=array(
	Yii::t('database', 'Reports'),
);
?>
<h1><?php echo Yii::t('database', 'Reports'); ?></h1>

<div class="dashboardIcons span-16">

    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/Reports/tickets"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-write.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/Reports/tickets"><?php echo Yii::t ('database','Tickets') ?></a></div>
    </div>
    <div class="messageButtonb blue">
        <a href="<?php echo Yii::app()->baseurl?>/Reports/operational"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-write.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/Reports/operational"><?php echo Yii::t ('database','Operational') ?></a></div>
    </div>
</div>
