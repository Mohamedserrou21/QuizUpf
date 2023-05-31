<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_index",methods={"GET"})
     */
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'quizzes' => $quizRepository->findAll(),
        ]);
    }
}
