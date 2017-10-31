<?php

namespace Leven\Controller;

use Leven\Model\CompanyManager;

class HomeController extends Controller
{
    public function homeAction()
    {
        $compagnyManager = new CompanyManager();
        $company = $compagnyManager->findFirst();

        return $this->twig->render(
            'home.html.twig',
            [
                'company' => $company,
                'brands' => $this->getAllBrands(),
            ]
        );
    }
}
