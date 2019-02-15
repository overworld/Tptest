<?php

require __DIR__.'/../lib/TheFrameWork/SplClassLoader.php';

$OCFramLoader = new SplClassLoader('TheFrameWork', __DIR__.'/../lib');
$OCFramLoader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../lib/vendors');
$entityLoader->register();

const DEFAULT_APP = 'Frontend';
if (!isset($_GET['app']) || !file_exists(__DIR__.'/../app/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;

$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();