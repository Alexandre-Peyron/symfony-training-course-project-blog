<?php

namespace AppBundle\Controller;

use Admin\BlogBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
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

        $articles = $em->getRepository('AdminBlogBundle:Article')->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
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
        return $this->render('default/about.html.twig');
    }

    /**
     * Page for Article
     *
     * @Route("/article/{slug}", name="front_article_show")
     *
     * @param Article $article An article instance directly request by SF
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticleAction(Article $article)
    {
        return $this->render('default/article.html.twig', [
            'article' => $article
        ]);
    }



}
