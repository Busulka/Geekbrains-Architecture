<?php
/* 1. Найти и указать в проекте Front Controller и расписать классы, которые с ним взаимодействуют.

Front Controller:
/web/index.php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$request = Request::createFromGlobals();
$containerBuilder = new ContainerBuilder();

Framework\Registry::addContainer($containerBuilder);

$response = (new Kernel($containerBuilder))->handle($request);
$response->send();


Взаимодействует с классами:
/src/controller/UserController.php
/src/controller/OrderController.php
/src/controller/ProductController.php
app/kernel.php

 *
 */
