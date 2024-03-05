<?php

// src/Entity/Section.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SectionRepository")
 * @ORM\Table(name="sections")
 */
class Section
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
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="sections")
     */
    private $lesson;

    /**
     * @ORM\OneToMany(targetEntity="Unit", mappedBy="section")
     */
    private $units;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->units = new ArrayCollection();
    }

    // Getters and Setters
    // Add your getters and setters here
}
