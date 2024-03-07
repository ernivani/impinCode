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

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getLesson()
    {
        return $this->lesson;
    }

    public function setLesson($lesson)
    {
        $this->lesson = $lesson;
    }

    public function getUnits()
    {
        return $this->units;
    }

    public function setUnits($units)
    {
        $this->units = $units;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function addUnit($unit)
    {
        $this->units[] = $unit;
    }

    public function removeUnit($unit)
    {
        $this->units->removeElement($unit);
    }

    
}