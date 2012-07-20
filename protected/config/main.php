<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SISPAD',
         'theme'=>'sispadred',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.extensions.*',
		'application.components.*',
                'application.extensions.yii-mail.*',

	),

	'modules'=>array(
                'rbac'
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
               'rbac'=>array(
                    // Table where Users are stored. RBAC Manager use it as read-only
                    'tableUser'=>'User',
                    // The PRIMARY column of the User Table
                    'columnUserid'=>'id',
                    // only for display name and could be same as id
                    'columnUsername'=>'username',
                    // only for display email for better identify Users
                    'columnEmail'=>'email' // email (only for display)
                    ),
                 'widgetFactory'=>array(
                        'widgets'=>array(
                            'CDetailView'=>array(

                                'cssFile' =>'/sispad/themes/sispadred/css/detailViewStyle.css',
                            ),
                            'CGridView'=>array(

                                'cssFile' =>'/sispad/themes/sispadred/css/gridViewStyle.css',
                            ),
               
                        ),
                ),
                'urlManager'=>array(
                        'urlFormat'=>'path',
                ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                 'mail' => array(
                'class' => 'application.extensions.yii-mail.YiiMail',
                'transportType'=>'smtp', /// case sensitive!
                'transportOptions'=>array(
                    'host'=>'smtp.gmail.com',
                    'username'=>'sispadcaruaru@gmail.com',
                    // or email@googleappsdomain.com
                    'password'=>'padti20123',
                    'port'=>'25'   ,//'465',
                    //'encryption'=>'ssl',
                    ),
                'viewPath' => 'application.views.mail',
                'logging' => true,
                'dryRun' => false
            ),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		//169.254.18.175
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=sispad',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
               'authManager'=>array(
                         'class'=>'CDbAuthManager', // Database driven Yii-Auth Manager
                          'connectionID'=>'db', // db connection as above
                         'defaultRoles'=>array('registered'), // default Role for logged in users
                         'showErrors'=>true, // show eval()-errors in buisnessRules
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
					'levels'=>'error, warning,info',
				),
                                array(
					'class'=>'CDbLogRoute',
					'levels'=>'error, warning,info',
                                        'connectionID'=>'db',
                                        'autoCreateLogTable'=>true,
                                        'logTableName'=>'log_system'
				),
//                                array(
//                                        'class'=>'CEmailLogRoute',
//                                        'levels'=>'error, warning,info',
//                                        'emails'=>'cesar.consultorjr@gmail.com',
//                                ),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);