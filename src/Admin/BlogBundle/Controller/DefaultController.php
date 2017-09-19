<?php

namespace Admin\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="dashboard")
     */
    public function indexAction()
    {
        return $this->render('dashboard/index.html.twig');
    }
}
