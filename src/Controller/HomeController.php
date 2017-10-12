<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 11/10/17
 * Time: 16:33
 */

namespace Leven\Controller;


class HomeController extends Controller
{
    public function homeAction()
    {
        return $this->twig->render('home.html.twig');
    }
}
