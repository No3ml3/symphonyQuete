<?php
// src/Controller/Defaultontroller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'website' => 'Wild Series',
         ]);
    }

    #[Route('/admin', name: 'admin_index')]
    public function indexAdmin(): Response
    {
        return $this->render('admin.html.twig');
    }
}