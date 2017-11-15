<?php

// change the following paths if necessary
$yii='./framework/yii.php';
$config='./protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// Defined ID for wine and food category
define('WINE_CATEGORY', 1);
define('FOOD_CATEGORY', 2);

require_once($yii);
Yii::createWebApplication($config)->run();
