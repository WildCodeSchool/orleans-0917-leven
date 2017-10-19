<?php
/**
 * Created by PhpStorm.
 * User: benjah
 * Date: 11/10/17
 * Time: 16:33
 */

namespace Leven\Controller;

use Leven\Model\IntroductionManager;

class HomeController extends Controller
{
    public function homeAction()
    {
        $introductionManager = new IntroductionManager();
        // on sait qu'il n'y aura qu'une seule entrée dans la table introduction
        $introduction = $introductionManager->find(3);


        return $this->twig->render('home.html.twig', [
            'intro' => $introduction,
        ]);

        //return $this->twig->render('home.html.twig');
    }
}
