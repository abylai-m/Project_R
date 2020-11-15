<?php

namespace App\Controller;

use App\Repository\DishRepository;
use App\Repository\UserDishRepository;
use App\Service\DishService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DishController extends AbstractController
{
    private DishRepository $dishRepository;
    private UserDishRepository $userDishRepository;
    private DishService $dishService;

    public function __construct(
        DishRepository $dishRepository,
        UserDishRepository $userDishRepository,
        DishService $dishService
    ) {
        $this->dishRepository = $dishRepository;
        $this->userDishRepository = $userDishRepository;
        $this->dishService = $dishService;
    }

    /**
     * @Route("/dish/list", name="dish_list")
     */
    public function dishListAction()
    {
        $user = $this->getUser();
        $userDishes = $this->userDishRepository->findByUser($user);
        $dishesFilteredByUserDishes = $this->userDishRepository->findDishesFilteredByUserDishes($userDishes);

        return $this->render('customer/dishes/dishes-list.html.twig', [
            'userDishes' => $userDishes,
            'dishesFilteredByUserDishes' => $dishesFilteredByUserDishes
        ]);
    }

    /**
     * @Route("/dish/order", name="dish_order", methods={"POST"})
     */
    public function orderAction(Request $request)
    {
        $user = $this->getUser();
        $dishId = (int) $request->request->get('dishId');

        $this->dishService->orderDish($user, $dishId);

        return $this->redirectToRoute('dish_list');
    }

    /**
     * @Route("/table/cancel-order", name="dish_cancel_order", methods={"POST"})
     */
    public function cancelOrderAction(Request $request)
    {
        $user = $this->getUser();
        $dishId = (int) $request->request->get('dishId');

        $this->dishService->cancelOrderDish($user, $dishId);

        return $this->redirectToRoute('dish_list');
    }
}
