<?php

namespace Leven\Controller;

use Leven\Model\Company;
use Leven\Model\CompanyManager;

class AdminController extends Controller
{
    public function adminAction()
    {
        $isMod = false;
        $compagnyManager = new CompanyManager();
        $company = $compagnyManager->find(1);

        if ($company) {
            $isMod = true;
        }

        $errorMessages = [];
        $successMessages = [];
        if (!empty($_POST)) {
            if (empty($_POST['content'])
                || empty(trim($_POST['content']))) {
                $errorMessages[] = 'Vous devez remplir l\'historique de la marque';
            }

            if (empty($errorMessages)) {
                if ($company) {
                    $company->setContent($_POST['content']);
                    $compagnyManager->update($company);
                } else {
                    //prend la variable newCompany et attend les indications '(soit insert soit update)
                    $newCompany = new Company();
                    //setter de content pour écriture une fois que nous validons
                    $newCompany->setContent($_POST['content']);

                    $compagnyManager = new CompanyManager();
                    $compagnyManager->insert($newCompany);

                    $company = $newCompany;
                }

                $successMessages[] = 'Modifications réussies';
            }
        }

        return $this->twig->render('admin.html.twig', [
            'company' => $company,
            'is_mod' => $isMod,
            'errorMessages' => $errorMessages,
            'successMessages' => $successMessages,
        ]);
    }
}
