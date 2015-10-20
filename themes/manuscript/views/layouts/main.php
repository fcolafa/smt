<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
</head>
<body>
<div class="content">
  <div id="header">
    <div class="title">
      <h1>sNEWS 1.5</h1>
      <h3>USE THIS TEMPLATE FOR FREE!</h3>
    </div>
  </div>
  <div id="main">
    <div class="center">
        <?php echo $content; ?>
      <!-- LEFT IT HERE FOR EXAMPLE
      <h2><a href="http://www.free-css.com/">Manuscript Template</a></h2>
      <h3>YOUR NEWS ON A OLD PAPER</h3>
      Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec sem. Praesent eu metus. Vivamus ac urna. Maecenas tincidunt libero id ipsum. Duis ipsum erat, laoreet in, ultrices at, blandit non, enim. Maecenas et libero. In laoreet vehicula enim. Nam at massa. Donec porttitor, odio id scelerisque pretium, augue eros cursus est, eget interdum dui justo et tellus. Aenean a neque eu mauris ultrices viverra. In ac urna. Etiam in dolor sit amet arcu auctor interdum. Fusce non quam. Nunc aliquet, quam eu facilisis venenatis, pede augue adipiscing lorem, nec tincidunt nunc felis eget odio. Integer iaculis pretium odio. Integer viverra. Integer porttitor elementum diam. In hac habitasse platea dictumst. Donec porta elit.
      <p class="date">Posted by Jack <img src="images/more.gif" alt="" /> <a href="http://www.free-css.com/">Read more</a> <img src="images/comment.gif" alt="" /> <a href="http://www.free-css.com/">Comments (15)</a> <img src="images/timeicon.gif" alt="" /> 17.01.</p>
      <br />
      <h2><a href="http://www.free-css.com/">Try it with sNews 1.4</a></h2>
      <h3>AND WHY NOT WITH sNEWS 1.5 ;-)</h3>
      Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec sem. Praesent eu metus. Vivamus ac urna. Maecenas tincidunt libero id ipsum. Duis ipsum erat, laoreet in, ultrices at, blandit non, enim. Maecenas et libero. In laoreet vehicula enim. Nam at massa. Donec porttitor, odio id scelerisque pretium, augue eros cursus est, eget interdum dui justo et tellus. Aenean a neque eu mauris ultrices viverra. In ac urna. Etiam in dolor sit amet arcu auctor interdum. Fusce non quam. Nunc aliquet, quam eu facilisis venenatis, pede augue adipiscing lorem, nec tincidunt nunc felis eget odio. Integer iaculis pretium odio. Integer viverra. Integer porttitor elementum diam. In hac habitasse platea dictumst. Donec porta elit.
      <p class="date">Posted by Jack <img src="images/more.gif" alt="" /> <a href="http://www.free-css.com/">Read more</a> <img src="images/comment.gif" alt="" /> <a href="http://www.free-css.com/">Comments (15)</a> <img src="images/timeicon.gif" alt="" /> 17.01.</p>
      <br />
      -->
    </div>
    <div class="leftmenu">
      <div class="nav">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
      </div>
    </div>
  </div>
  <div id="prefooter">
    <div class="particles">
      <h2>Top Articles</h2>
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">Integer euismod ante non diam adipiscing</a> <br />
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">consectetuer adipiscing elit dolor sit amet</a> <br />
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">Lorem ipsum dolor sit amet ipsum dolor</a><br />
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">Integer euismod ante non adipiscing elit </a><br />
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">Lorem ipsum dolor sit amet euismod ante</a><br />
    </div>
    <div class="comments">
      <h2>Last Comments</h2>
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">Integer euismod ante non diam adipiscing</a> <br />
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">consectetuer adipiscing elit dolor sit amet</a> <br />
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">Lorem ipsum dolor sit amet ipsum dolor</a><br />
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">Integer euismod ante non adipiscing elit </a><br />
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow.gif" alt="" /> <a href="http://www.free-css.com/">Lorem ipsum dolor sit amet euismod ante</a><br />
    </div>
  </div>
  <div id="footer">
    <div class="padding"> Copyright &copy; <?php echo date( 'Y', time() ) . ' ' . CHtml::encode( Yii::app()->name ); ?>    
    | Design: <a href="http://www.free-css-templates.com">David Herreman </a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.solucija.com">Solucija.com</a> | <a href="http://www.free-css.com/">Login</a> </div>
  </div>
</div>
</body>
</html>
