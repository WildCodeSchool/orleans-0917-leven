<?php

require '../vendor/autoload.php';
require '../connect.php';

use Leven\Controller\Admin\CompanyController;
use Leven\Controller\Admin\BrandController;
use Leven\Controller\ErrorController;

if (!empty($_GET['route'])) {
    $route = $_GET['route'];
} else {
    $route = 'leven';
}

if ($route == 'leven') {
    $companyController = new CompanyController();
    echo $companyController->companyAction();
} else if ($route == 'marques') {
    $brandAdminController = new BrandController();
    echo $brandAdminController->brandAction();
} else if ($route == 'edit-marque') {
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $brandAdminController = new BrandController();
        echo $brandAdminController->editBrandAction($_GET['id']);
    } else {
        $errorController = new ErrorController();
        echo $errorController->notFoundAction();
    }
} else if ($route == 'ajout-marque') {
    $brandAdminController = new BrandController();
    echo $brandAdminController->addBrandAction();
} else {
    $errorController = new ErrorController();
    echo $errorController->notFoundAction(true);
}
