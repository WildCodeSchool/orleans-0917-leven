<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 11/10/17
 * Time: 16:33
 */

namespace Leven\Controller;

use Leven\Model\CompanyManager;

class HomeController extends Controller
{
    public function homeAction()
    {
        $compagnyManager = new CompanyManager();
        // on sait qu'il n'y aura qu'une seule entrée dans la table company
        $company = $compagnyManager->find(1);

        return $this->twig->render('home.html.twig', [
            'company' => $company,
        ]);
    }
}
