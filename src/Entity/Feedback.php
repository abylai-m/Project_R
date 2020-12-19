<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FeedbackRepository;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass=FeedbackRepository::class)
 */
class Feedback
{
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
     * @ORM\Column(type="string", nullable=false)
     */
    private $text;

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getText(): string 
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}