<?php

namespace Leven\Controller;

use Leven\Model\CompanyManager;

class HomeController extends Controller
{
    public function homeAction()
    {
        $companyManager = new CompanyManager();
        $company = $companyManager->findFirst();

        return $this->twig->render(
            'home.html.twig',
            [
                'company' => $company,
                'brands' => $this->getAllBrands(),
            ]
        );
    }
}
