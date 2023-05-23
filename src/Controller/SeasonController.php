<?php

namespace App\Controller;

use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
use App\Entity\Category;
use App\Entity\Program;
use App\Entity\Episode;

#[Route('/season', name: 'season_')]
class SeasonController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SeasonRepository $seasonRepository): Response
    {
        $seasons = $seasonRepository->findAll();

        return $this->render('season/index.html.twig', [
            'seasons' => $seasons,
        ]);
    }
    
    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show(Season $season, EpisodeRepository $episodeRepository): Response
    {
        $episodes = $episodeRepository->findAll();
        return $this->render('season/show.html.twig', [
            'season' => $season,
            'episodes' => $episodes
        ]);
    }

}