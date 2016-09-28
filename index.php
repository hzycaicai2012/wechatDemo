<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
define('BASE_PATH', dirname(__FILE__) . '/');
define('APPLICATION_PATH', BASE_PATH . 'protected/');
define('RUNTIME_PATH', APPLICATION_PATH . 'runtime/');
Yii::setPathOfAlias('template',dirname(__FILE__).'/protected/template/');
Yii::createWebApplication($config)->run();
