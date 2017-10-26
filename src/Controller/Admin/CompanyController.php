<?php

namespace Leven\Controller\Admin;

use Leven\Controller\Controller;
use Leven\Model\Company;
use Leven\Model\CompanyManager;

class CompanyController extends Controller
{
    public function companyAction()
    {
        $isMod = false;
        $compagnyManager = new CompanyManager();
        $company = $compagnyManager->find(1);

        if ($company) {
            $isMod = true;
        }

        $errorMessages = [];
        $successMessages = [];
        $youtube_id = "";

        if (!empty($_POST)) {
            if (empty(trim($_POST['content']))) {
                $errorMessages[] = 'Vous devez remplir l\'historique de la marque';
            }

            if (!empty($_POST['video_link'])) {
                $link = $_POST['video_link'];
                $reg = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)' .
                    '/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
                if (preg_match($reg, $link, $videoid)) {
                    if (isset($videoid[1])) {
                        $youtube_id = $videoid[1];
                    } else {
                        $errorMessages[] = 'Impossible de récupérer l\'identifiant de la vidéo youtube.';
                    }
                } else {
                    $errorMessages[] = 'Le lien de la vidéo doit provenir de Youtube';
                }
            }
            if (empty($errorMessages)) {
                if (!$company) {
                    $company = new Company();
                }

                $company->setContent($_POST['content']);
                $company->setVideoLink($youtube_id);

                if ($isMod) {
                    $compagnyManager->update($company);
                } else {
                    $compagnyManager->insert($company);
                }

                $successMessages[] = 'Modifications réussies';
            }
        }

        return $this->twig->render(
            'Admin/company.html.twig',
            [
                'brands' => $this->getAllBrands(),
                'company' => $company,
                'isMod' => $isMod,
                'errorMessages' => $errorMessages,
                'successMessages' => $successMessages,
            ]
        );
    }
}
