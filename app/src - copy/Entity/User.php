<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $AvatarUri;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ActionTime;

    /**
     * @ORM\ManyToMany(targetEntity=Participate::class, mappedBy="CodUser")
     */
    private $CodUser;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function __construct()
    {
        $this->CodUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getAvatarUri(): ?string
    {
        return $this->AvatarUri;
    }

    public function setAvatarUri(string $AvatarUri): self
    {
        $this->AvatarUri = $AvatarUri;

        return $this;
    }

    public function getActionTime(): ?\DateTimeInterface
    {
        return $this->ActionTime;
    }

    public function setActionTime(?\DateTimeInterface $ActionTime): self
    {
        $this->ActionTime = $ActionTime;

        return $this;
    }

    /**
     * @return Collection|Participate[]
     */
    public function getCodUser(): Collection
    {
        return $this->CodUser;
    }

    public function addCodUser(Participate $codUser): self
    {
        if (!$this->CodUser->contains($codUser)) {
            $this->CodUser[] = $codUser;
            $codUser->addCodUser($this);
        }

        return $this;
    }

    public function removeCodUser(Participate $codUser): self
    {
        if ($this->CodUser->removeElement($codUser)) {
            $codUser->removeCodUser($this);
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
