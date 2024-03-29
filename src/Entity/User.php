<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Course;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlimage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Progress", mappedBy="user")
     */
    private $progress;

    /**
     * @ORM\ManyToOne(targetEntity="Lesson")
     */
    private $lastLesson;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastLogin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTemporary = false;

    // Getters and Setters

    public function __construct()
    {
        $this->progress = new ArrayCollection();
        $this->isActive = true; // Set default active status
        $this->roles = ['ROLE_USER']; // Set default role
    }

    
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist(): void
    {
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime("now");
    }
    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getProgress(): Collection
    {
        return $this->progress;
    }

    public function addProgress(Progress $progress): self
    {
        if (!$this->progress->contains($progress)) {
            $this->progress[] = $progress;
            $progress->setUser($this);
        }
        return $this;
    }

    
    public function getLastLesson(): ?Lesson
    {
        return $this->lastLesson;
    }

    public function setLastLesson(?Lesson $lastLesson): self
    {
        $this->lastLesson = $lastLesson;
        return $this;
    }

    public function deleteLastLesson(): self
    {
        $this->lastLesson = null;
        return $this;
    }

    public function getUrlimage(): ?string
    {
        return $this->urlimage;
    }

    public function setUrlimage(?string $urlimage): self
    {
        $this->urlimage = $urlimage;
        return $this;
    }

    public function getIsTemporary(): ?bool
    {
        return $this->isTemporary;
    }

    public function setIsTemporary(bool $isTemporary): self
    {
        $this->isTemporary = $isTemporary;
        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }


    public function generateAuthToken(): string
    {
        $key = $_ENV['JWT_SECRET_KEY'];
        $payload = [
            'iss' => "your_issuer", // Issuer of the token
            'aud' => "your_audience", // Intended recipient of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + (60*60), // Expiration time
            'sub' => $this->getId(), // Subject of the token (the user id)
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');

        return $jwt;
    }
    

}