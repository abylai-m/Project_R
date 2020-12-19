<?php 

namespace App\Service;

use App\Repository\FeedbackRepository;
use App\Entity\User;
use App\Entity\Feedback;

class FeedbackService 
{
    private FeedbackRepository $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function save(User $user, string $text): void
    {
        $feedback = (new Feedback())
            ->setUser($user)
            ->setText($text);

        $this->feedbackRepository->save($feedback);
    }

    /**
     * @return Feedback[]
     */
    public function getAll(): array
    {
        return $this->feedbackRepository->findAll();
    }
}