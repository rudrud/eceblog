<?php

namespace Ece\ArticleBundle\Controller;

use Ece\ArticleBundle\Entity\Article;
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
     * @Route("/ajouter")
     */
    public function ajouterAction()
    {
        $article = new Article();
        $article->setNom('Premier article de test');
        $article->setDescription('Lorem ipsum ....');
        $article->setDate(new \DateTime());

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($article);
        $manager->flush();

        exit;
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
