<?php

namespace AppBundle\Controller;

use Admin\BlogBundle\Entity\Article;
use Admin\BlogBundle\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AdminBlogBundle:Article')->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/article/{slug}", name="front_article_show")
     */
    public function showArticleAction(Article $article)
    {
        return $this->render('default/article.html.twig', [
            'article' => $article
        ]);
    }



}
