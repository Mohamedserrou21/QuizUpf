<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Score;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Question;
use App\Entity\Answers;

/**
 * @Route("/quiz")
 */
class QuizController extends AbstractController
{
    /**
     * @Route("/", name="app_quiz_index", methods={"GET"})
     */
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_quiz_new", methods={"GET", "POST"})
     */
    public function new(Request $request, QuizRepository $quizRepository): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizRepository->add($quiz, true);

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_quiz_show", methods={"GET"})
     */
    public function show(Quiz $quiz): Response
    {
        return $this->render('quiz/quiz.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_quiz_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizRepository->add($quiz, true);

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_quiz_delete", methods={"POST"})
     */
    public function delete(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $quiz->getId(), $request->request->get('_token'))) {
            $quizRepository->remove($quiz, true);
        }

        return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
    }


    //calculer

    /**
     * @Route("/{id}/sub", name="user_submit_quiz", methods={"POST"})
     */
    public function submitQuiz(Request $request, Security $security, $id, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();

        if (!$user) {
            throw new AccessDeniedException('Vous devez être connecté pour soumettre le quiz.');
        }

        $quiz = $entityManager->getRepository(Quiz::class)->find($id);

        if (!$quiz) {
            throw $this->createNotFoundException('Le quiz demandé n\'existe pas.');
        }

        $questions = $quiz->getQuestions();
        $totalQuestions = count($questions);
        $correctAnswers = 0;

        foreach ($questions as $question) {
            $questionId = $question->getId();
            $submittedAnswerId = $request->request->get('question' . $questionId);

            if ($submittedAnswerId) {
                $submittedAnswer = $entityManager->getRepository(Answers::class)->find($submittedAnswerId);

                if (!$submittedAnswer) {
                    throw $this->createNotFoundException('La réponse soumise n\'existe pas.');
                }

                if ($submittedAnswer->getIsCorrect()) {
                    $correctAnswers++;
                }
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;

        $scoreEntity = new Score();
        $scoreEntity->setUser($user);
        $scoreEntity->setScore($score);
        $scoreEntity->setQuiz($quiz);

        $entityManager->persist($scoreEntity);
        $entityManager->flush();

        return $this->render('quiz/result.html.twig', [
            'score' => $scoreEntity, // Utilisez l'objet $scoreEntity au lieu de $score
        ]);
    }
}
