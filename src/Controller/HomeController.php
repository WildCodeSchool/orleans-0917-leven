<?php

namespace Leven\Controller;

use Leven\Model\CompanyManager;

class HomeController extends Controller
{
    public function homeAction()
    {
        $compagnyManager = new CompanyManager();
        $company = $compagnyManager->find(1);

        $this->buildCompanyPicturePaths($company);

        return $this->twig->render(
            'home.html.twig',
            [
                'company' => $company,
                'brands' => $this->getAllBrands(),
            ]
        );
    }
}
