<?php

require '../vendor/autoload.php';
require '../connect.php';

use Leven\Controller\BrandStyleController;
use Leven\Controller\HomeController;
use Leven\Controller\BrandController;
use Leven\Controller\ErrorController;

if (!empty($_GET['route'])) {
    $route = $_GET['route'];
} else {
    $route = 'accueil';
}

if ($route == 'accueil') {
    $homeController = new HomeController();
    echo $homeController->homeAction();
} elseif ($route == 'marque') {
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $brandController = new BrandController();
        echo $brandController->brandAction($_GET['id']);
    } else {
        $errorController = new ErrorController();
        echo $errorController->notFoundAction();
    }
} elseif ($route == 'brand-style') {
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $brandStyleController = new BrandStyleController();
        header('Content-Type: text/css');
        echo $brandStyleController->brandStyleAction($_GET['id']);
    } else {
        $errorController = new ErrorController();
        echo $errorController->notFoundAction();
    }
} else {
    $errorController = new ErrorController();
    echo $errorController->notFoundAction();
}
