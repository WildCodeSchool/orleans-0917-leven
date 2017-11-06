<?php

namespace Leven\Controller;


class MentionsController extends Controller
{
    public function mentionsAction()
    {
        return $this->twig->render('mentions.html.twig');
    }
}
