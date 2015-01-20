<?php
namespace Ece\ArticleBundle\Controller;


use Ece\ArticleBundle\Entity\Article;
use Ece\ArticleBundle\Form\ArticleType;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ArticleApiController extends FOSRestController
{
    /**
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method",
     *  filters={
     *      {"name"="a-filter", "dataType"="integer"},
     *      {"name"="another-filter", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  }
     * )
     */
    public function getArticlesAction()
    {
        $articles = $this->getDoctrine()->getRepository('EceArticleBundle:Article')->findAccueil();
        $view = $this->view($articles, 200);
        return $this->handleView($view);
    }


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