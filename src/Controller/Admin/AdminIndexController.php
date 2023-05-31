<?php

namespace App\Controller\Admin;

use App\Repository\QuizRepository;
use App\Repository\AnswersRepository;
use App\Repository\QuestionRepository;
use App\Repository\UserRepository;
use App\Entity\Answers;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Entity\Score;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminIndexController extends AbstractDashboardController
{
    protected UserRepository $userRepository;
    protected AnswersRepository $ansrRepository;
    protected QuestionRepository $qsrRepository;
    protected QuizRepository $quizRepository;

    public function __construct(UserRepository $userRepository, AnswersRepository $ansrRepository, QuestionRepository $qsrRepository, QuizRepository $quizRepository)
    {
        $this->userRepository = $userRepository;
        $this->ansrRepository = $ansrRepository;
        $this->qsrRepository = $qsrRepository;
        $this->quizRepository = $quizRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'countUser' => $this->userRepository->countAllUser(),
            'countAnswer' => $this->ansrRepository->countAllAnswer(),
            'countQuestion' => $this->qsrRepository->countAllQuestion(),
            'countQuiz' => $this->quizRepository->countAllQuiz(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Université Privée De Fès');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Quiz', 'far fa-calendar-check', Quiz::class);
        yield MenuItem::linkToCrud('Question', 'fa fa-book', Question::class);
        yield MenuItem::linkToCrud('Réponse', 'fa fa-pencil-square-o', Answers::class);
        yield MenuItem::linkToCrud('Résultats', 'fa fa-paste', Score::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-paste', User::class);
    }
}
