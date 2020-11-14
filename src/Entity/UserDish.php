<?php

namespace App\Entity;

use App\Repository\UserDishRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=UserDishRepository::class)
 */
class UserDish
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Dish::class)
     */
    private $dish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDish(): Dish
    {
        return $this->dish;
    }

    public function setDish(Dish $dish): self
    {
        $this->dish = $dish;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }
}
