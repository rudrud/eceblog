<?php

namespace Ece\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArticleController extends Controller
{
    /**
     * @Route("/lister")
     * @Template()
     */
    public function listerAction()
    {
        return array();
    }


    /**
     * @Route("/afficher/{id}")
     * @Template()
     */
    public function afficherAction($id)
    {


        $name = "coucou".uniqid();

        return array('id' => $id, 'name' => $name);
    }
}
