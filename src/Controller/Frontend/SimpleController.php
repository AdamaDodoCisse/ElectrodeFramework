<?php

namespace ElectrodeSource\Controller\Frontend;

use ElectrodeFramework\Controller\AbstractController;

class SimpleController extends AbstractController
{

    public function indexAction($name)
    {
        $this->render('Frontend:Simple:index', compact('name'));
    }
}