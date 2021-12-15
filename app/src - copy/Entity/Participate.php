<?php

namespace App\Entity;

use App\Repository\ParticipateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipateRepository::class)
 */
class Participate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="CodUser")
     */
    private $CodUser;

    /**
     * @ORM\ManyToMany(targetEntity=Chat::class, inversedBy="CodChat")
     */
    private $CodChat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateEnter;

    public function __construct()
    {
        $this->CodUser = new ArrayCollection();
        $this->CodChat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getCodUser(): Collection
    {
        return $this->CodUser;
    }

    public function addCodUser(User $codUser): self
    {
        if (!$this->CodUser->contains($codUser)) {
            $this->CodUser[] = $codUser;
        }

        return $this;
    }

    public function removeCodUser(User $codUser): self
    {
        $this->CodUser->removeElement($codUser);

        return $this;
    }

    /**
     * @return Collection|Chat[]
     */
    public function getCodChat(): Collection
    {
        return $this->CodChat;
    }

    public function addCodChat(Chat $codChat): self
    {
        if (!$this->CodChat->contains($codChat)) {
            $this->CodChat[] = $codChat;
        }

        return $this;
    }

    public function removeCodChat(Chat $codChat): self
    {
        $this->CodChat->removeElement($codChat);

        return $this;
    }

    public function getDateEnter(): ?\DateTimeInterface
    {
        return $this->DateEnter;
    }

    public function setDateEnter(?\DateTimeInterface $DateEnter): self
    {
        $this->DateEnter = $DateEnter;

        return $this;
    }
}
