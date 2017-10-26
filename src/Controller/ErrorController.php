<?php

namespace Leven\Controller;


class ErrorController extends Controller
{
    public function notFoundAction($isAdmin = false, $errorMessage = false)
    {
        return $this->twig->render(
            'error.html.twig',
            [
                'brands' => $this->getAllBrands(),
                'errorMessage' => $errorMessage,
                'errorTitle' => 'Page non trouvée',
                'isAdmin' => $isAdmin
            ]
        );
    }
}
