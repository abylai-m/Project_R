<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("", name="app_homepage")
     */
    public function homepageAction()
    {
        return $this->render('homepage.html.twig');
    }
}