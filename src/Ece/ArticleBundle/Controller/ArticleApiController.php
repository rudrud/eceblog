<?php
namespace Ece\ArticleBundle\Controller;


use Ece\ArticleBundle\Entity\Article;
use Ece\ArticleBundle\Form\ArticleType;
use FOS\RestBundle\Controller\FOSRestController;
//use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ArticleApiController extends FOSRestController
{

    public function getArticlesAction()
    {
        $articles = $this->getDoctrine()->getRepository('EceArticleBundle:Article')->findAccueil();
        $view = $this->view($articles, 200);
        return $this->handleView($view);
    }

    // {"ece_articlebundle_article":{"nom":"test", "description":"description", "date":{"date":{"year":"2015","month":"1", "day":"1"}, "time":{"hour":0, "minute":0}},"categorie":1}}
    public function postArticlesAction(Request $request){
        $article = new Article();

        $formArticle = $this->createForm(new ArticleType(), $article, array('csrf_protection' => false));

        $formArticle->submit($request);

        if ($formArticle->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();
            return new Response('', Response::HTTP_CREATED);
        } else {
            $view = $this->view($formArticle->getErrors(), Response::HTTP_BAD_REQUEST);
            return $this->handleView($view);
        }

    }

}