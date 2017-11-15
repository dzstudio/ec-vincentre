<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
  'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
  'name'=>'Vincent',

  // preloading 'log' component
  'preload'=>array('log'),

  // autoloading model and component classes
  'import'=>array(
    'application.models.*',
    'application.components.*',
    'application.controllers.*',
    'application.extensions.helper.*',
    'application.services.*'
  ),

  'modules'=>array(
    'gii'=>array(
      'class'=>'system.gii.GiiModule',
      'password'=>'123'
    ),
    'admin'
  ),

  // application components
  'components'=>array(
    'user'=>array(
      // enable cookie-based authentication
      'allowAutoLogin'=>true
    ),
    'session' => array(
      'timeout' => '1800'
    ),
    'urlManager'=>array(
      'urlFormat'=>'path',
      'showScriptName'=>false,
      'rules'=>array(
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '/' => ''
      ),
    ),
    'db'=>array(
      'connectionString' => 'mysql:host=localhost;dbname=vincent',
      'emulatePrepare' => true,
      'username' => 'dev',
      'password' => '123',
      'charset' => 'utf8',
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
      ),
    ),
  ),

  // application-level parameters that can be accessed
  // using Yii::app()->params['paramName']
  'params'=>array(
    // this is used in contact page
  ),
);