<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
Class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
         ]);
    }

    #[Route('/show/{id<\d+>}', methods: ['GET'], name: 'show')]
    public function program_show(int $id = 1): Response
    {
        return $this->render('program/program_show.html.twig', [
            'id' => $id,
         ]);
    }
}
