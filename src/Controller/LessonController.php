<?php

// src/Controller/LessonController.php
namespace App\Controller;

use App\Entity\Course;
use App\Entity\Lesson;
use App\Entity\Leçon;
use App\Entity\Progress;
use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Entity\Question;
use App\Entity\Unit;

class LessonController extends AbstractController
{
    #[Route(path: '/validate-answer', name: 'validate_answer', methods: ['POST'])]
    public function validateAnswerAction(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $questionId = $data['questionId'];
        $answerId = $data['answerId'];

        $correctAnswerId = $this->entityManager->getRepository(Question::class)->find($questionId)->getCorrectAnswer()->getId();


        header('Content-Type: application/json');
        echo json_encode(['correctAnswerId' => $correctAnswerId, 'correct' => $data['answerId'] == $correctAnswerId]);
        exit;
    }

    #[Route(path: '/fetch-answers', name: 'fetch_answers', methods: ['POST'])]
    public function fetchAnswersAction(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $questionId = $data['questionId'];

        $question = $this->entityManager->getRepository(Question::class)->find($questionId);
        $answers = [];

        if ($question) {
            foreach ($question->getAnswers() as $answer) {
                $answers[] = [
                    'id' => $answer->getId(),
                    'content' => $answer->getContent(),
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['answers' => $answers]);
        exit;
    }

    // update-progress
    #[Route(path: '/update-progress', name: 'update_progress', methods: ['POST'])]
    public function updateProgressAction(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $lessonId = $data['lessonId'];
        $userId = $_SESSION['user'];

        $user = $this->entityManager->getRepository(User::class)->find($userId);
        $lesson = $this->entityManager->getRepository(Lesson::class)->find($lessonId);
        $progress = $this->entityManager->getRepository(Progress::class)->findOneByUserAndLesson($user, $lesson);

        if (!$progress) {
            $progress = new Progress();
            $progress->setUser($user);
            $progress->setLesson($lesson);
        }


        if ($progress->getCompletion() >= $lesson->getCompletion()) {
            $unit = $lesson->getUnit();
            $nextLesson = $this->entityManager->getRepository(Lesson::class)->findOneNextByUnit($unit, $lesson);

            if (!$nextLesson) {
                $nextUnit = $this->entityManager->getRepository(Unit::class)->findOneNextBySection($unit->getSection(), $unit);
                if ($nextUnit) {
                    $nextLesson = $this->entityManager->getRepository(Lesson::class)->findOneByUnit($nextUnit);
                }
            }

            if ($nextLesson) {
                $user->setLastLesson($nextLesson);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'nextLesson' => $nextLesson ? $nextLesson->getId() : null]);
            exit;
        }
        $progress->addCompletion(1);

        $this->entityManager->persist($progress);
        $this->entityManager->flush();
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;
    }
}