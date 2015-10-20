
<?php  
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile('http://www.google.com/jsapi');
  $cs->registerCoreScript('jquery');
  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.css');

?>
<script type="text/javascript">

  $(document).ready(function(){
  var droplist = $('#graphicsyear');
  var dropyear;
    droplist.change(function(e){
        dropyear=$('#graphicsyear').val();
         jQuery.ajax({
                        url: "<?php echo Yii::app()->createAbsoluteUrl('site/year') ?>",
                        type: 'POST',
                        data: { 'yearg' : dropyear },
                        success:function(data){
                           document.location.href='http://localhost/optic/site/index/'+data;
                        }
                });
    });
 });

</script>

<?php $this->pageTitle=Yii::app()->name; ?>

<h1><i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<div class="span-23 showgrid">
<div class="dashboardIcons span-16">

    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseurl?>/provider/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-people.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/provider/"><?php echo Yii::t ('database','Providers') ?></a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->createUrl('/site/reports') ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-chart.png" alt="Page" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->createUrl('/site/reports') ?>"><?php echo Yii::t('database','Reports')?></a></div>
    </div>
  <?php if(Yii::app()->user->checkAccess('Control Total')){?>
     <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseurl?>/city/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-map2.png" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/city/"><?php echo Yii::t('database','Cities') ?></a></div>
    </div>
    <div class="dashIcon span-3">
        <a href="<?php echo Yii::app()->baseurl?>/site/globalConfig/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/big_icons/icon-gears.png" /></a>
        <div class="dashIconText"><a href="<?php echo Yii::app()->baseurl?>/site/globalConfig/"><?php echo Yii::t('database','Global Configuration') ?></a></div>
    </div>
  <?php }?>
     
    
   
    
</div><!-- END OF .dashIcons -->

</div>
<div class="graphic">          
<?php
   
     $date=  date("Y"); 

$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>Yii::t('actions','Sales Chart')." ".$yearg,
));
//$year="SELECT year(t.date) FROM `sales` `t` GROUP BY year(t.date)";
//        $years=  Yii::app()->db->createCommand($year)->queryAll();
//        $yfinal= array();
//        foreach($years as $y){
//           $yfinal[$y['year(t.date)']]=$y['year(t.date)'];
//        }
//        echo CHtml::dropDownList('graphicsyear', 'year(t.date)', $yfinal,array('prompt'=>Yii::t('actions','Select')." ".Yii::t('database','Year')));
//        echo "<br>";
 

?>
<div class="chart3">
    <div>
        <div class="text">
            <table class="myChart">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Enero</th>
                        <th>Febrero</th>
                        <th>Marzo</th>
                        <th>Abril</th>
                        <th>Mayo</th>
                        <th>Junio</th>
                        <th>Julio</th>
                        <th>Agosto</th>
                        <th>Septiembre</th>
                        <th>Octubre</th>
                        <th>Noviembre</th>
                        <th>Diciembre</th>
                       
                    </tr>
                </thead>
                <tbody>
                        <?php 
//                       $office=Office::model()->findAll();
//                       if(isset($office)){
//                        foreach ($office as $o){
//                        echo "<tr>";   
//                        echo "<th>".$o->office_name."</th>";
//                        $command = Yii::app()->db->createCommand(" call monthsales(". $o->id_office .",'".$yearg."') ");
//                        $month = $command->queryAll();
//                        $sales=array_fill(1,12,0);
//                             foreach($month as $m){
//                           for($i=1;$i<=12;$i++){
//                                if($i==intval($m['month(s.date)']))
//                                    $sales[$i]=intval($m['sum(s.price)']);
//                                }
//                            }
//                             foreach($sales as $sale){
//                                     
//                                    echo "<td style='font-weight:bold'>".$sale."</td>";
//                             }
//                        echo "</tr>";
//                        }
//                    }
                        ?>                 
                </tbody>
            </table>
        </div>
    </div>
</div>
    
<?php $this->endWidget();?>

</div>
