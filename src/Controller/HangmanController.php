<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WordRepository;

class HangmanController extends AbstractController
{
    #[Route('/hangman', name: 'app_hangman')]
    public function index(WordRepository $wordRepository): Response
    {
        return $this->render('hangman/index.html.twig', [
            'words' => $wordRepository->findAll(),
        ]);
    }
    #[Route('/hangman/game', name: 'app_hangman_game')]
    public function game(WordRepository $wordRepository): Response
    {
        return $this->render('hangman/game.html.twig', [
            'words' => $wordRepository->findAll(),
        ]);
    }
}
