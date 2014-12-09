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
        $articles = $this->getDoctrine()->getRepository('EceArticleBundle:Article')->findAccueil();

        return array("articles" => $articles);
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
     * @Route("/afficher/{id}", name="article_afficher")
     * @Template()
     */
    public function afficherAction($id)
    {
        $article = $this->getDoctrine()->getRepository('EceArticleBundle:Article')->find($id);

        return array('article' => $article);
    }
}
