<?php
// src/Entity/Course.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 * @ORM\Table(name="courses")
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
    * @ORM\OneToMany(targetEntity="Section", mappedBy="course")
     */
    private $sections;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    // Getters and Setters

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
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

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getSections()
    {
        return $this->sections;
    }

    public function setSections($sections): self
    {
        $this->sections = $sections;
        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
    

    public function getTotalLessonsCount()
    {
        $total = 0;
        foreach ($this->sections as $section) {
            $total += count($section->getLessons());
        }
        return $total;
    }

    
    public function getCompletedLessonsCountByAllUsers(EntityManager $entityManager)
    {
        $total = 0;
        foreach ($this->sections as $section) {
            $total += $section->getCompletedLessonsCountByAllUsers($entityManager);
        }
        return $total;
    }
}
