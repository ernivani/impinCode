<?php 

// src/Entity/Course.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
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
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="courses")
     */
    private $unit;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="course")
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
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
    
    public function getUnit(): ?Unit
    {
        return $this->unit;
    }
    
    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;
    
        return $this;
    }
    
    public function getQuestions(): ArrayCollection
    {
        return $this->questions;
    }
    
    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setCourse($this);
        }
    
        return $this;
    }
    
    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            if ($question->getCourse() === $this) {
                $question->setCourse(null);
            }
        }
    
        return $this;
    }
}

