<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserDishRepository;
use App\Repository\UserRepository;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DishController extends AbstractController
{
    private UserDishRepository $userDishRepository;

    public function __construct(UserDishRepository $userDishRepository)
    {
        $this->userDishRepository = $userDishRepository;
    }

    /**
     * @Route("/admin/dish/statistics", name="admin.dish.statistics")
     */
    public function getStatisticsAction(Request $request)
    {
        $dateFromRequest = $request->get('date');
        $date = $dateFromRequest ? \DateTime::createFromFormat('Y-m-d', $dateFromRequest) : new \DateTime();

        $dishes = $this->userDishRepository->findUserDishesWithCountByDate($date);

        return $this->render('admin/dishes/statistics.html.twig', [
            'dishes' => $dishes
        ]);
    }
}
