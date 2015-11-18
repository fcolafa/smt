<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SMT',
	'language'=>'es',
	'sourceLanguage'=>'en',
	'charset'=>'utf-8',
        'timeZone'=>'America/Santiago',
        'theme'=>'blackboot',

	// preloading 'log' component
	'preload'=>array('log'),
	// autoloading model and component classes
	'import'=>array(
                'application.vendors.phpexcel.PHPExcel',
		'application.models.*',
		'application.components.*',
                'application.extensions.jtogglecolumn.*',
                'application.extensions.coco.*',     
                
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
               
               'gii'=>array(
                      'class'=>'system.gii.GiiModule',
                       'password'=>'1234',
                      // If removed, Gii defaults to localhost only. Edit carefully to taste.
                      'ipFilters'=>array('127.0.0.1','::1'),
                              'generatorPaths'=>array(
                                    'application.modules.gii',   // a path alias
                             ),
               ),
         //
            'wdcalendar'    => array( 'embed' => true ),
                 
		
	),

	// application components
	'components'=>array(
            
                //component from new theme
            
            'widgetFactory'=>array(
                    'class'=>'CWidgetFactory',
        
                    
            'widgets'=>array(
                'CGridView'=>array(
                    'htmlOptions'=>array('cellspacing'=>'0','cellpadding'=>'0'),
					'itemsCssClass'=>'item-class',
					'pagerCssClass'=>'pager-class'
                ),
                'CJuiTabs'=>array(
                    'htmlOptions'=>array('class'=>'shadowtabs'),
                ),
                'CJuiAccordion'=>array(
                    'htmlOptions'=>array('class'=>'shadowaccordion'),
                ),
                'CJuiProgressBar'=>array(
                   'htmlOptions'=>array('class'=>'shadowprogressbar'),
                ),
                'CJuiSlider'=>array(
                    'htmlOptions'=>array('class'=>'shadowslider'),
                ),
                'CJuiSliderInput'=>array(
                    'htmlOptions'=>array('class'=>'shadowslider'),
                ),
                'CJuiButton'=>array(
                    'htmlOptions'=>array('class'=>'shadowbutton'),
                ),
                'CJuiButton'=>array(
                    'htmlOptions'=>array('class'=>'shadowbutton'),
                ),
                'CJuiButton'=>array(
                    'htmlOptions'=>array('class'=>'button green'),
                ),
     
               
            ),
        ),
                'mailer' => array(
                    'class' => 'application.extensions.mailer.EMailer',
                    'pathViews' => 'application.views.email',
                    'pathLayouts' => 'application.views.email.layouts'
                 ),
                  'Smtpmail'=>array(
                        'class'=>'application.extensions.smtpmail.PHPMailer',
                        'Host'=>"mail.eject.cl",
                        'Username'=>'hys@eject.cl',
                        'Password'=>'13579r2d2',
                        'Mailer'=>'smtp',
                        'Port'=>25,
                        'SMTPAuth'=>true,
                  ),
            
   
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
                        //'authTimeout'=>( Yii::app()->params['sessionTime']+1)*60,
		),
		// uncomment the following to enable URLs in path-format
	
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
                'authManager'=> array(
                    'class'=>'CDbAuthManager',
                    'connectionID'=>'db',
                ),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=smtsa_sistema',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
                        'enableProfiling'=>true,
		),
		'coreMessages'=>array(
			'basePath'=>'protected/messages',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),	
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
        /**
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'btnclass'=>'button grey',
            ),
    **/
    'params'=>require(dirname(__FILE__).'/params.php'),
);