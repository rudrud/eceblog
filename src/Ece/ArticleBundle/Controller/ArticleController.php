<?php

namespace Ece\ArticleBundle\Controller;

use Doctrine\Common\Util\Debug;
use Ece\ArticleBundle\Entity\Article;
use Ece\ArticleBundle\Entity\Categorie;
use Ece\ArticleBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    /**
     * @Route("/lister", name="article_lister")
     * @Template()
     */
    public function listerAction()
    {
        $articles = $this->getDoctrine()->getRepository('EceArticleBundle:Article')->findAccueil();

        return array("articles" => $articles);
    }

    /**
     * @Route("/ajouter", name="article_ajouter")
     * @Template()
     */
    public function ajouterAction(Request $request)
    {
        $article = new Article();

        $formArticle = $this->createForm(new ArticleType(), $article);

        $formArticle->handleRequest($request);

        if ($formArticle->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirect($this->generateUrl('article_lister'));
        }

        return array("formArticle" => $formArticle->createView());
    }

    /**
     * @Route("/modifier/{id}", name="article_modifier")
     * @Template()
     * @ParamConverter()
     */
    public function modifierAction(Article $article, Request $request)
    {
        $formArticle = $this->createForm(new ArticleType(), $article);

        $formArticle->handleRequest($request);

        if ($formArticle->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirect($this->generateUrl('article_lister'));
        }


        return array("article" => $article, "formArticle" => $formArticle->createView());
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
