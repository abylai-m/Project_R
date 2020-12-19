<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FeedbackService;

class HomePageController extends AbstractController
{
    private FeedbackService $feedbackService;
    
    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    /**
     * @Route("", name="app_homepage")
     */
    public function homepageAction()
    {
        $feedbacks = $this->feedbackService->getAll();

        return $this->render('homepage.html.twig', [
            'feedbacks' => $feedbacks
        ]);
    }
}