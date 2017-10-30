<?php

namespace Leven\Controller\Admin;

use Leven\Controller\Controller;
use Leven\Model\Company;
use Leven\Model\CompanyManager;

class CompanyController extends Controller
{
    public function companyAction()
    {
        $uploaders = [
            'company_picture1' => false,
            'company_picture2' => false,
            'company_picture3' => false
        ];

        $isMod = false;
        $compagnyManager = new CompanyManager();
        $company = $compagnyManager->find(1);

        if ($company) {
            $isMod = true;
        }

        $errorMessages = [];
        $successMessages = [];
        $youtube_id = "";

        if (!empty($_POST) || !empty($_FILES)) {
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

            foreach ($uploaders as $imgId => $uploader) {
                $uploaders[$imgId] = $this->createImageUploader($imgId, $errorMessages);
            }

            if (empty($errorMessages)) {
                if (!$company) {
                    $company = new Company();
                }

                foreach ($uploaders as $imgId => $uploader) {
                    if ($uploader) {
                        if (!$uploader->upload()) {
                            $errorMessages = array_merge($errorMessages, $uploader->getErrorMessages());
                            $uploaders[$imgId] = false;
                        }
                    }
                }

                $company->setContent($_POST['content']);
                $company->setVideoLink($youtube_id);

                if ($uploaders['company_picture1']) {
                    $this->tryDeleteFile($company->getPicture1());
                    $company->setPicture1($uploaders['company_picture1']->getNewFileName());
                }
                if ($uploaders['company_picture2']) {
                    $this->tryDeleteFile($company->getPicture2());
                    $company->setPicture2($uploaders['company_picture2']->getNewFileName());
                }
                if ($uploaders['company_picture3']) {
                    $this->tryDeleteFile($company->getPicture3());
                    $company->setPicture3($uploaders['company_picture3']->getNewFileName());
                }

                if ($isMod) {
                    $compagnyManager->update($company);
                } else {
                    $compagnyManager->insert($company);
                }

                $successMessages[] = 'Modifications réussies';
            }

            $this->buildCompanyPicturePaths($company);
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
