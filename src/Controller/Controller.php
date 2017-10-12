<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 11/10/17
 * Time: 16:11
 */

namespace Leven\Controller;

/**
 * Class Controller
 * @package Leven
 */
class Controller
{
    /**
     * The twig loader
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Controller constructor.
     */
    public function __construct ()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false,
        ));
    }
}
