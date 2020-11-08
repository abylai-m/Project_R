<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="order")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=OrderDish::class, mappedBy="order")
     */
    private $orderDishes;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->orderDishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setOrder($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getOrder() === $this) {
                $user->setOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderDish[]
     */
    public function getOrderDishes(): Collection
    {
        return $this->orderDishes;
    }

    public function addOrderDish(OrderDish $orderDish): self
    {
        if (!$this->orderDishes->contains($orderDish)) {
            $this->orderDishes[] = $orderDish;
            $orderDish->addOrder($this);
        }

        return $this;
    }

    public function removeOrderDish(OrderDish $orderDish): self
    {
        if ($this->orderDishes->removeElement($orderDish)) {
            $orderDish->removeOrder($this);
        }

        return $this;
    }
}
