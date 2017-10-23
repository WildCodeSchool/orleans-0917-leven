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
        $youtube_id = "";

        if (!empty($_POST)) {
            if (empty($_POST['content'])
                || empty(trim($_POST['content']))) {
                $errorMessages[] = 'Vous devez remplir l\'historique de la marque';
            }

            if (!empty($_POST['video_link'])) {
                $link = $_POST['video_link'];
                $reg = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)' .
                    '/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
                if (preg_match($reg, $link, $videoid)) {
                    if (isset($videoid) && count($videoid) == 2) {
                        $youtube_id = $videoid[1];
                    }
                } else {
                    $errorMessages[] = 'Le lien de la vidéo doit provenir de Youtube';
                }
            }
            if (empty($errorMessages)) {
                if ($company) {
                    $company->setContent($_POST['content']);
                    $company->setVideoLink($youtube_id);
                    $compagnyManager->update($company);
                } else {
                    //prend la variable newCompany et attend les indications '(soit insert soit update)
                    $newCompany = new Company();
                    //setter de content pour écriture une fois que nous validons
                    $newCompany->setContent($_POST['content']);
                    $newCompany->setVideoLink($youtube_id);

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
