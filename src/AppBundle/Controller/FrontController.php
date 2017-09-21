<?php

namespace AppBundle\Controller;

use Admin\BlogBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    /**
     * Homepage
     *
     * @Route("/", name="homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AdminBlogBundle:Article')->findAllOrderByDate();

        // replace this example code with whatever you need
        return $this->render('front/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * Page About
     *
     * @Route("/about", name="about")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        return $this->render('front/about.html.twig');
    }

    /**
     * Page for Article
     *
     * @Route("/article/{slug}", name="front_article_show")
     *
     * @param Article $article An article instance directly request by SF
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticleAction(Article $article)
    {
        return $this->render('front/article.html.twig', [
            'article' => $article
        ]);
    }
}
