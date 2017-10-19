<?php

namespace Leven\Controller;

use Leven\Model\Introduction;
use Leven\Model\IntroductionManager;

class AdminController extends Controller
{
    public function adminAction()
    {
        $introductionManager = new IntroductionManager();
        $introduction = $introductionManager->find(0);
        $errors = [];
        if (!empty($_POST)) {
            if (empty($_POST['introduction'])
                || empty(trim($_POST['introduction']))) {
                $errors[] = 'Vous devez remplir l\'historique de la marque';
            }

            if (empty($errors)) {
                //prend la variable newIntroduction et attend les indications '(soit insert soit update)
                $newIntroduction = new Introduction();
                //setter de content pour écriture une fois que nous validons
                $newIntroduction->setContent($_POST['introduction']);
                if (!empty($introduction)) {
                    // TODO: Update
                    //$introduction->setContent($_POST['introduction']);
                    //$introductionManager->update($introduction);
                } else {
                    $introductionManager = new IntroductionManager();
                    $introductionManager->insert($newIntroduction);

                    $introduction = $newIntroduction;
                }
            }
        }
        return $this->twig->render('admin.html.twig', [
            'intro' => $introduction,
        ]);
    }
}
