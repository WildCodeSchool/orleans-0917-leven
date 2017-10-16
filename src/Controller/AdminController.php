<?php

namespace Leven\Controller;


class AdminController extends Controller
{
    public function adminAction()
    {
        return $this->twig->render('admin.html.twig');
    }
}
