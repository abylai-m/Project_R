<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FeedbackService;

class FeedbackController extends AbstractController
{
    private FeedbackService $feedbackService;
    
    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

     /**
     * @Route("/feedback/save", name="feedback_save", methods={"POST"})
     */
    public function saveAction(Request $request)
    {
        $user = $this->getUser();
        $text = $request->request->get('text');

        $this->feedbackService->save($user, $text);

        return $this->redirectToRoute('app_homepage');   
    }
}
