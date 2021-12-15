<?php

namespace App\Entity;

use App\Repository\ChatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChatRepository::class)
 */
class Chat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $ChatName;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $ChatImageUri;

    /**
     * @ORM\ManyToMany(targetEntity=Participate::class, mappedBy="CodChat")
     */
    private $CodChat;

    public function __construct()
    {
        $this->CodChat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChatName(): ?string
    {
        return $this->ChatName;
    }

    public function setChatName(string $ChatName): self
    {
        $this->ChatName = $ChatName;

        return $this;
    }

    public function getChatImageUri(): ?string
    {
        return $this->ChatImageUri;
    }

    public function setChatImageUri(string $ChatImageUri): self
    {
        $this->ChatImageUri = $ChatImageUri;

        return $this;
    }

    /**
     * @return Collection|Participate[]
     */
    public function getCodChat(): Collection
    {
        return $this->CodChat;
    }

    public function addCodChat(Participate $codChat): self
    {
        if (!$this->CodChat->contains($codChat)) {
            $this->CodChat[] = $codChat;
            $codChat->addCodChat($this);
        }

        return $this;
    }

    public function removeCodChat(Participate $codChat): self
    {
        if ($this->CodChat->removeElement($codChat)) {
            $codChat->removeCodChat($this);
        }

        return $this;
    }
}
