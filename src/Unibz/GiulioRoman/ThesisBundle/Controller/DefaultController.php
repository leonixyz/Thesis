<?php

namespace Unibz\GiulioRoman\ThesisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ThesisBundle:Default:index.html.twig', array('name' => $name));
    }
}
