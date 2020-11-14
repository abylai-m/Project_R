<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    private UserRepository $userRepository;
    private UserService $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * @Route("/admin/user/list", name="admin.user.list")
     */
    public function getListAction()
    {
        $user = $this->getUser();
        $users = $this->userRepository->findUsersExcludedOneById($user->getId());

        return $this->render('admin/users/users-list.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/user/edit", name="admin.user.edit.view", methods={"GET"})
     */
    public function editUserViewAction(Request $request)
    {
        $userId = $request->get('userId');
        $user = $this->userRepository->find($userId);

        return $this->render('admin/users/edit-user.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/admin/user/edit", name="admin.user.edit.action", methods={"POST"})
     */
    public function editUserAction(Request $request)
    {
        $userId = $request->request->get('userId');
        $email = $request->request->get('email');

        $user = $this->userRepository->find($userId);
        $this->userRepository->updateUser($user, $email);

        return $this->redirectToRoute('admin.user.list');
    }

    /**
     * @Route("/admin/user/create", name="admin.user.create.view", methods={"GET"})
     */
    public function createUserViewAction()
    {
        return $this->render('admin/users/create-user.html.twig', [
            'roles' => User::ROLES_MAPPING
        ]);
    }

    /**
     * @Route("/admin/user/create", name="admin.user.create.action", methods={"POST"})
     */
    public function createUserAction(Request $request)
    {
        $email = $request->request->get('email');
        $role = $request->request->get('role');
        $password = $request->request->get('password');

        $this->userService->createUser($email, $role, $password);

        return $this->redirectToRoute('admin.user.list');
    }
}
