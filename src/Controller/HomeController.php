<?php

namespace Leven\Controller;

use Leven\Model\CompanyManager;

class HomeController extends Controller
{
    public function homeAction()
    {
        $compagnyManager = new CompanyManager();
        $company = $compagnyManager->find(1);

        if (!empty($company->getPicture1())) {
            $company->setPicture1('assets/images/uploads/' . $company->getPicture1());
        }

        if (!empty($company->getPicture2())) {
            $company->setPicture2('assets/images/uploads/' . $company->getPicture2());
        }

        if (!empty($company->getPicture3())) {
            $company->setPicture3('assets/images/uploads/' . $company->getPicture3());
        }

        return $this->twig->render(
            'home.html.twig',
            [
                'company' => $company,
                'brands' => $this->getAllBrands(),
            ]
        );
    }
}
