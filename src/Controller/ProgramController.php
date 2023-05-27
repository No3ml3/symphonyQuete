<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository, RequestStack $requestStack, ): Response
    {
        $programs = $programRepository->findAll();

        $session = $requestStack->getSession();

        if (!$session->has('total')) {
            $session->set('total', 0); // if total doesn’t exist in session, it is initialized.
        }
    
        $total = $session->get('total');

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programRepository->save($program, true);  
            $this->addFlash('success', 'The new program has been created');
            return $this->redirectToRoute('program_index');          
        }

        return $this->render('program/new.html.twig', [
            'form' => $form,
            'program' => $program,
        ]);
    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
public function show(program $program): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with this id is not found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }
    
    #[Route('/show/{program}/season/{season}', requirements: ['program' => '\d+', 'season' => '\d+'], methods: ['GET'], name: 'season_show')]
    public function showSeason(program $program, season $season): Response
    {
        return $this->render('program/season_show.html.twig', ['program' => $program, 'season' => $season]);
    }
    
    #[Route('/show/{program}/season/{season}/episode/{episode}', requirements: ['program' => '\d+', 'season' => '\d+', 'episode' => '\d+'], methods: ['GET'], name: 'episode_show')]
    public function showEpisode(program $program, season $season, episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', ['program' => $program, 'season' => $season, 'episode' => $episode]);
    }
}
