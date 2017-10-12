<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 11/10/17
 * Time: 17:08
 */

namespace Leven\Controller;

class BrandController extends Controller
{
    public function brandAction()
    {
        return $this->twig->render('brand.html.twig');
    }
}
