<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 11/10/17
 * Time: 15:55
 */

require '../vendor/autoload.php';

use Leven\Controller\HomeController;
use Leven\Controller\BrandController;

// Routeur basique, necessite une url index.php?route=xxx
$route = $_GET['route'];

// On appelle une methode d'un controlleur en fonction de la route saisie en URL
if ($route == 'accueil') {
    $homeController = new HomeController();
    echo  $homeController->homeAction();
} elseif ($route == 'marques') {
    $brandController = new BrandController();
    echo  $brandController->brandAction();
} else {
    echo 'La page n\'existe pas';
}

exit();
