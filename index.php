<?php

// change the following paths if necessary
define('BASE_PATH', dirname(__FILE__));
$yii=dirname(__FILE__).'/../../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$mainConfig = require BASE_PATH . '/protected/config/main.php';
$databaseConfig = require BASE_PATH . '/protected/config/database.php';
$paramsConfig = require BASE_PATH . '/protected/config/params.php';
$config = CMap::mergeArray($mainConfig, $databaseConfig, $paramsConfig);
Yii::createWebApplication($config)->run();
