<?php

namespace App\Entity;

use App\Repository\OrderDishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDishRepository::class)
 */
class OrderDish
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class)
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity=Dish::class)
     */
    private $dish;

    public function __construct()
    {
        $this->order = new ArrayCollection();
        $this->dish = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrder(): Collection
    {
        return $this->order;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->order->contains($order)) {
            $this->order[] = $order;
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        $this->order->removeElement($order);

        return $this;
    }

    /**
     * @return Collection|Dish[]
     */
    public function getDish(): Collection
    {
        return $this->dish;
    }

    public function addDish(Dish $dish): self
    {
        if (!$this->dish->contains($dish)) {
            $this->dish[] = $dish;
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        $this->dish->removeElement($dish);

        return $this;
    }
}
