<?php

namespace Admin\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{
    /**
     * @Route("/admin", name="dashboard")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nbArticles   = $em->getRepository('AdminBlogBundle:Article')->countAll();
        $nbCategories = $em->getRepository('AdminBlogBundle:Category')->countAll();
        $nbTag        = $em->getRepository('AdminBlogBundle:Tag')->countAll();
        $nbUser       = $em->getRepository('AdminUserBundle:User')->countAll();

        return $this->render('dashboard/index.html.twig', [
            'nbArticles'   => $nbArticles,
            'nbCategories' => $nbCategories,
            'nbTag'        => $nbTag,
            'nbUser'       => $nbUser
        ]);
    }
}
