<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuizzoController extends AbstractController
{
    /**
     * @Route("/quizzo", name="quizzo")
     */
    public function index()
    {
        return $this->render('quizzo/index.html.twig', [
            'controller_name' => 'QuizzoController',
        ]);
    }
}
