<?php

namespace OysterPro28Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlaningController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
