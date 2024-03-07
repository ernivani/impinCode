<?php 

// src/Controller/AdminController.php
namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Section;
use App\Entity\Unit;
use App\Entity\Question;
use App\Entity\Answer;
use App\Form\LessonType;
use App\Form\SectionType;
use App\Form\UnitType;
use App\Form\QuestionType;
use App\Form\AnswerType;
use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\Course;
use App\Form\CourseType;

class AdminController extends AbstractController
{
    protected \Doctrine\ORM\EntityManager $entityManager;

    #[Route(path: '/admin/lessons', name: 'admin_lessons')]
    public function createLesson()
    {


        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(LessonType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $lesson = new Lesson();
            $lesson->setTitle($data['title']);
            $lesson->setDescription($data['description']);
            $this->entityManager->persist($lesson);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_lessons');
        }

        
        return $this->render('admin/new_lesson', [
            'title' => 'Nouvelle leçon',
            'form' => $form->render(),
            'lessons' => $this->entityManager->getRepository(Lesson::class)->findAll()
        ]);
    }

    #[Route(path: '/admin/lessons/{id}/sections', name: 'admin_sections')]
    public function addSection(int $id)
    {
        $form = $this->createForm(SectionType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $section = new Section();
            $section->setTitle($data['title']);
            $section->setLesson($this->entityManager->getRepository(Lesson::class)->find($id));
            $this->entityManager->persist($section);
            $this->entityManager->flush();


            return $this->redirectToRoute('admin_sections', ['id' => $id]);
        }

        return $this->render('admin/new_section', [
            'form' => $form->render(),
            'lessonId' => $id,
            'sections' => $this->entityManager->getRepository(Section::class)->findByLessonId($id)
        ]);
    }


    #[Route(path: '/admin/sections/{id}/units', name: 'admin_units')]
    public function addUnit(int $id)
    {
        $form = $this->createForm(UnitType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $unit = new Unit();
            $unit->setTitle($data['title']);
            $unit->setSection($this->entityManager->getRepository(Section::class)->find($id));
            $this->entityManager->persist($unit);
            $this->entityManager->flush();


            return $this->redirectToRoute('admin_units', ['id' => $id]);
        }

        return $this->render('admin/new_unit', [
            'form' => $form->render(),
            'sectionId' => $id,
            'units' => $this->entityManager->getRepository(Unit::class)->findBySectionId($id)
        ]);
    }

    #[Route(path: '/admin/units/{id}/courses', name: 'admin_course')]
    public function addCourse(int $id)
    {
        $form = $this->createForm(CourseType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $course = new Course();
            $course->setTitle($data['title']);
            $course->setUnit($this->entityManager->getRepository(Unit::class)->find($id));
            $this->entityManager->persist($course);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_course', ['id' => $id]);
        }

        return $this->render('admin/new_course', [
            'form' => $form->render(),
            'title' => 'Nouveau cours',
            'courses' => $this->entityManager->getRepository(Course::class)->findByUnitId($id)
        ]);
    }



    #[Route(path: '/admin/course/{id}/questions', name: 'admin_questions')]
    public function addQuestion(int $id)
    {
        $form = $this->createForm(QuestionType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $question = new Question();
            $question->setContent($data['content']);
            $question->setCourse($this->entityManager->getRepository(Course::class)->find($id));
            $this->entityManager->persist($question);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_questions', ['id' => $id]);
        }

        return $this->render('admin/new_question', [
            'form' => $form->render(),
            'unitId' => $id,
            'questions' => $this->entityManager->getRepository(Question::class)->findByCourseId($id)
        ]);
    }

    #[Route(path: '/admin/questions/{id}/answers', name: 'admin_answers')]
    public function addAnswer(int $id)
    {
        $form = $this->createForm(AnswerType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $answer = new Answer();
            $answer->setContent($data['content']);
            $answer->setIsCorrect($data['isCorrect']);
            $answer->setQuestion($this->entityManager->getRepository(Question::class)->find($id));
            $this->entityManager->persist($answer);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_answers', ['id' => $id]);
        }

        return $this->render('admin/new_answer', [
            'form' => $form->render(),
            'questionId' => $id,
            'answers' => $this->entityManager->getRepository(Answer::class)->findByQuestionId($id)
        ]);
    }
    
};
