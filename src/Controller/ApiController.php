<?php

namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Entity\Section;
use App\Entity\Unit;
use App\Entity\Lesson;
use App\Entity\Course;
use App\Entity\Question;
use App\Entity\Answer;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiController extends AbstractController
{
    protected \Doctrine\ORM\EntityManager $entityManager;

    #[Route(path: '/api/login', name: 'api_login', methods: ['POST'])]
    public function apiLoginAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['username']) || !isset($data['password'])) {
            return $this->jsonResponse(['error' => 'Identifiant et mot de passe requis'], 400);
        }

        $username = $data['username'];
        $user = $this->entityManager->getRepository(User::class)->findOneByEmailOrUsername($username);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        if (password_verify($data['password'], $user->getPassword())) {
            $user->setLastLogin(new \DateTime());
            $this->entityManager->flush();

            return $this->jsonResponse(['success' => 'Vous êtes connecté', 'token' => $user->generateAuthToken()]);
        } else {
            return $this->jsonResponse(['error' => 'Identifiant ou mot de passe incorrect'], 401);
        }
    }

    #[Route(path: '/api/check-token', name: 'api_check_token', methods: ['POST'])]
    public function apiCheckTokenAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $token = $data['token'] ?? '';

        if (empty($token)) {
            return $this->jsonResponse(['error' => 'Token non fourni'], 401);
        }

        try {
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            $userId = $decoded->sub;
            $user = $this->entityManager->getRepository(User::class)->find($userId);

            if (!$user) {
                return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
            }

            return $this->jsonResponse([
                'success' => true,
                'user' => [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail(),
                ]
            ]);

        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }
    }

    #[Route(path: '/api/my-course', name: 'api_register', methods: ['POST'])]
    public function myCourseAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token'])) {
            return $this->jsonResponse(['error' => 'Token requis'], 400);
        }

        $token = $data['token'];

        try {
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }

        $userId = $decoded->sub;
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        $userLastLesson = $user->getLastLesson();

        if ($userLastLesson === null) {
            return $this->jsonResponse(['error' => 'Aucune leçon n\'a été commencée'], 404);
        }

        $course = $userLastLesson->getUnit()->getSection()->getCourse();

        return $this->jsonResponse([
            'success' => true,
            'course' => [
                'id' => $course->getId(),
                'title' => $course->getTitle(),
                'description' => $course->getDescription(),
            ]
        ]);
    }

    #[Route(path: '/api/course/{id}/sections', name: 'api_course_sections', methods: ['GET'])]
    public function getSectionsAction($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token'])) {
            return $this->jsonResponse(['error' => 'Token requis'], 400);
        }
        $token = $data['token'];

        try {
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }
        $userId = $decoded->sub;
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        $course = $this->entityManager->getRepository(Course::class)->find($id);

        if (!$course) {
            return $this->jsonResponse(['error' => 'Cours non trouvé'], 404);
        }

        $sections = $course->getSections();

        $sectionsData = [];
        foreach ($sections as $section) {
            $sectionsData[] = [
                'id' => $section->getId(),
                'title' => $section->getTitle(),
            ];
        }

        return $this->jsonResponse([
            'success' => true,
            'sections' => $sectionsData,
        ]);
    }

    #[Route(path: '/api/section/{id}/units', name: 'api_section_units', methods: ['GET'])]
    public function getUnitsAction($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token'])) {
            return $this->jsonResponse(['error' => 'Token requis'], 400);
        }
        $token = $data['token'];

        try {
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }
        $userId = $decoded->sub;
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        $section = $this->entityManager->getRepository(Section::class)->find($id);

        if (!$section) {
            return $this->jsonResponse(['error' => 'Section non trouvée'], 404);
        }

        $units = $section->getUnits();

        $unitsData = [];
        foreach ($units as $unit) {
            $unitsData[] = [
                'id' => $unit->getId(),
                'title' => $unit->getTitle(),
            ];
        }

        return $this->jsonResponse([
            'success' => true,
            'units' => $unitsData,
        ]);
    }

    #[Route(path: '/api/unit/{id}/lessons', name: 'api_unit_lessons', methods: ['GET'])]
    public function getLessonsAction($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token'])) {
            return $this->jsonResponse(['error' => 'Token requis'], 400);
        }
        $token = $data['token'];

        try {
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }
        $userId = $decoded->sub;
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        $unit = $this->entityManager->getRepository(Unit::class)->find($id);

        if (!$unit) {
            return $this->jsonResponse(['error' => 'Unité non trouvée'], 404);
        }

        $lessons = $unit->getLessons();

        $lessonsData = [];
        foreach ($lessons as $lesson) {
            $lessonsData[] = [
                'id' => $lesson->getId(),
                'title' => $lesson->getTitle(),
            ];
        }

        return $this->jsonResponse([
            'success' => true,
            'lessons' => $lessonsData,
        ]);
    }

    #[Route(path: '/api/lesson/{id}/questions', name: 'api_lesson_questions', methods: ['GET'])]
    public function getQuestionsAction($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token'])) {
            return $this->jsonResponse(['error' => 'Token requis'], 400);
        }
        $token = $data['token'];

        try {
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }
        $userId = $decoded->sub;
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        $lesson = $this->entityManager->getRepository(Lesson::class)->find($id);

        if (!$lesson) {
            return $this->jsonResponse(['error' => 'Leçon non trouvée'], 404);
        }

        $questions = $lesson->getQuestions();

        $questionsData = [];
        foreach ($questions as $question) {
            $questionsData[] = [
                'id' => $question->getId(),
                'content' => $question->getContent(),
            ];
        }

        return $this->jsonResponse([
            'success' => true,
            'questions' => $questionsData,
        ]);
    }

    #[Route(path: '/api/question/{id}/answers', name: 'api_question_answers', methods: ['GET'])]
    public function getAnswersAction($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token'])) {
            return $this->jsonResponse(['error' => 'Token requis'], 400);
        }
        $token = $data['token'];

        try {
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }
        $userId = $decoded->sub;
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        $question = $this->entityManager->getRepository(Question::class)->find($id);

        if (!$question) {
            return $this->jsonResponse(['error' => 'Question non trouvée'], 404);
        }

        $answers = $question->getAnswers();

        $answersData = [];
        foreach ($answers as $answer) {
            $answersData[] = [
                'id' => $answer->getId(),
                'content' => $answer->getContent(),
            ];
        }

        return $this->jsonResponse([
            'success' => true,
            'answers' => $answersData,
        ]);
    }

    #[Route(path: '/api/answer/validate', name: 'api_answer_validate', methods: ['POST'])]
    public function validateAnswerAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['token'])) {
            return $this->jsonResponse(['error' => 'Token requis'], 400);
        }

        if (!isset($data['answer'])) {
            return $this->jsonResponse(['error' => 'Réponse requise'], 400);
        }
        $token = $data['token'];
        $id = $data['answer'];

        try {
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }
        $userId = $decoded->sub;
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        $answer = $this->entityManager->getRepository(Answer::class)->find($id);

        if (!$answer) {
            return $this->jsonResponse(['error' => 'Réponse non trouvée'], 404);
        }

        $question = $answer->getQuestion();
        $lesson = $question->getLesson();
        $unit = $lesson->getUnit();
        $section = $unit->getSection();
        $course = $section->getCourse();

        $userLastLesson = $user->getLastLesson();

        if ($userLastLesson === null || $userLastLesson->getId() !== $lesson->getId()) {
            return $this->jsonResponse(['error' => 'Vous n\'avez pas accès à cette leçon'], 403);
        }

        $isCorrect = $answer->getIsCorrect();

        return $this->jsonResponse([
            'success' => true,
            'isCorrect' => $isCorrect,
        ]);
    }
}
