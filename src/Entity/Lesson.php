<?php 

// src/Entity/Lesson.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 * @ORM\Table(name="lessons")
 */
class Lesson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $ordre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="lessons")
     */
    private $unit;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="lesson")
     */
    private $questions;

    /**
     * @ORM\Column(type="integer")
     */
    private $completion;

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
    
    public function getQuestions()
    {
        return $this->questions;
    }
    
    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setLesson($this);
        }
    
        return $this;
    }
    
    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            if ($question->getLesson() === $this) {
                $question->setLesson(null);
            }
        }
    
        return $this;
    }

    public function getCompletion(): ?int
    {
        return $this->completion;
    }

    public function setCompletion(int $completion): self
    {
        $this->completion = $completion;

        return $this;
    }

    
    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;
        return $this;
    }

    public function isCompleted(User $user, EntityManager $entityManager): bool
    {
        $progress = $entityManager->getRepository(Progress::class)->findOneByUserAndLesson($user, $this);
        if ($progress) {
            return $progress->getCompletion() >= $this->getCompletion();
        }
        return false;
    }
}

