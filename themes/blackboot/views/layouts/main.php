<?php
	Yii::app()->clientscript
		// use it when you need it!
		
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/tables.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/screen.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/form.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/main.css' )
     		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
		
?>
<!DOCTYPE html>
<html lang="es">
<head>
    
    
          <script type="text/javascript">    
        var guest="<?php echo Yii::app()->user->isGuest?'false':'true'?>";
        var stime=parseInt("15");
        $(document).ready(function () {
		var idleState = false;
		var idleTimer = null;
        $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
            clearTimeout(idleTimer);
            if (idleState == true && guest=='true') { 
                 alert("Sesión expirada por Inactividad ") ; 
                 window.location.replace("<?php echo Yii::app()->createAbsoluteUrl("Site/logout"); ?>");
                 idleState=false;
            }
            idleState = false;
            idleTimer = setTimeout(function () {idleState = true; }, stime*60000);
        });
    }
    );     
         
     </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="es" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<!-- Le fav and touch icons -->
</head>

<body>
   
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
                            <a class="brand" href="#"><img class="logo" border=”0″ src="<?php echo Yii::app()->theme->baseUrl?>/img/smt.png"></a>
				<div class="nav-collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array( 'class' => 'nav' ),
						'activeCssClass'	=> 'active',
						'items'=>array(
							array('label'=>Yii::t('database','Home'), 'url'=>array('/site/index')),
							array('label'=>Yii::t('actions','Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Cerrar Sesión ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
							//array('label'=>count(Ticket::model()->findAll('ticket_status="No leido"')),'url'=>'#','itemOptions'=>array('class' =>'ticket')),
						),
					)); ?>
                                    
				</div><!--/.nav-collapse -->
                                <?php if(Yii::app()->user->checkAccess('Administrador')){ ?>
                                <div class="ticket">
                                    <?php 
                                    $count= count(Ticket::model()->findAll('ticket_status="En Curso"'));
                                    $count2= count(Ticket::model()->findAll('ticket_status="Nuevo"'));
                                    $count3= count(Ticket::model()->findAll('ticket_status="Cerrado"'));
                                    ?>
                                    
                                    <a id="circle" class="tooltips"  href="<?php echo Yii::app()->createUrl('/ticket/admin', array('status'=>"En Curso")) ?>"><?php echo $count ?> <span>Solicitudes en Curso</span></a>
                                    <a  id="circle"  class="tooltips" href="<?php echo Yii::app()->createUrl('/ticket/admin',array('status'=>"Nuevo")) ?>"><?php echo $count2 ?><span>Solicitudes Nuevas</span></a>
                                    </div>
                                <?php } ?>
			</div>
		</div>
	</div>
       
	
	<div class="cont">
	<div class="container-fluid">
   
	  <?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink'=>false,
				'tagName'=>'ul',
				'separator'=>'',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array ('class'=>'breadcrumb')
			)); ?>
		<!-- breadcrumbs -->
	  <?php endif?>
	 <div class="info" style="text-align: left;">
         
        <?php $flashMessages=Yii::app()->user->getFlashes();
        
        if($flashMessages){
            echo '<ul class="flashes">';
            foreach ( $flashMessages as $key =>$message){
                echo '<li><div class="flash-'.$key.'">'. $message . "</div></li>\n";
        }
      echo '</ul>';
            }   
        ?>
        </div>
	<?php echo $content ?>
	
	 
	</div><!--/.fluid-container-->
         
	</div>
<!--	
	<div class="extra">
	  <div class="container">
                -->
             
<!--		<div class="row">
			<div class="col-md-3">
				<h4>Heading 1</h4>
				<ul>
					<li><a href="#">Subheading 1.1</a></li>
					<li><a href="#">Subheading 1.2</a></li>
					<li><a href="#">Subheading 1.3</a></li>
					<li><a href="#">Subheading 1.4</a></li>
				</ul>
			</div>  /span3 
			
			<div class="col-md-3">
				<h4>Heading 2</h4>
				<ul>
					<li><a href="#">Subheading 2.1</a></li>
					<li><a href="#">Subheading 2.2</a></li>
					<li><a href="#">Subheading 2.3</a></li>
					<li><a href="#">Subheading 2.4</a></li>
				</ul>
			</div>  /span3 
			
			<div class="col-md-3">
				<h4>Heading 3</h4>	
				<ul>
					<li><a href="#">Subheading 3.1</a></li>
					<li><a href="#">Subheading 3.2</a></li>
					<li><a href="#">Subheading 3.3</a></li>
					<li><a href="#">Subheading 3.4</a></li>
				</ul>
			</div>  /span3 
			
			<div class="col-md-3">
				<h4>Heading 4</h4>
				<ul>
					<li><a href="#">Subheading 4.1</a></li>
					<li><a href="#">Subheading 4.2</a></li>
					<li><a href="#">Subheading 4.3</a></li>
					<li><a href="#">Subheading 4.4</a></li>
				</ul>
				</div>  /span3 
			</div>  /row -->
                          
	<!--	</div> <!-- /container -->
	<!--</div>
	-->
<!--	<div class="footer">
	  <div class="container">
		<div class="row">
			<div id="footer-copyright" class="col-md-6">
				About us | Contact us | Terms & Conditions
			</div>  /span6 
			<div id="footer-terms" class="col-md-6">
				© 2012-13 Black Bootstrap. <a href="http://nachi.me.pn" target="_blank">Nachi</a>.
			</div>  /.span6 
		 </div>  /row 
	  </div>  /container 
	</div>-->
</body>
</html>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect',
        '$(".info").animate({opacity:1.0},10000).slideUp("slow");',
        CClientScript::POS_READY
        );