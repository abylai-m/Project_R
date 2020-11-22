<?php

namespace App\Entity;

use App\Repository\EmployeeReportRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=EmployeeReportRepository::class)
 */
class EmployeeReport
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
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=UserDish::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $userDish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUserDish(): ?UserDish
    {
        return $this->userDish;
    }

    public function setUserDish(?UserDish $userDish): self
    {
        $this->userDish = $userDish;

        return $this;
    }
}
