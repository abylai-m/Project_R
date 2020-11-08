<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(2, 'users_customers', function(int $i) {
            $user = new User();
            $user->addRole(User::ROLE_CUSTOMER);
            $user->setEmail(sprintf('test%d@mail.com', $i));
            $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'password'));
            return $user;
        });

        $this->createMany(1, 'users_admins', function(int $i) {
            $user = new User();
            $user->addRole(User::ROLE_ADMIN);
            $user->setEmail('admin@mail.com');
            $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'password'));
            return $user;
        });

        $manager->flush();
    }
}
