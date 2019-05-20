<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TemporaryController extends AbstractController
{
    /**
     * @Route("/compare", name="compare")
     */
    public function index()
    {
        return $this->render('compare/compare.html.twig', [
            'controller_name' => 'TemporaryController',
        ]);
    }
}
