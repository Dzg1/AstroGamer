<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Repository\WordRepository;
use App\Entity\User;

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
        // Récupérer tous les mots de la base de données
        $words = $wordRepository->findAll();
        
        // Générer un nombre aléatoire
        $randomIndex = rand(0, count($words) - 1);
        
        // Récupérer le mot aléatoire
        $word = $words[$randomIndex];


    
        // Passer les variables à la vue
        return $this->render('hangman/game.html.twig', [
            'word' => $word,


        ]);
    }
    #[Route('/hangman/game/word', name: 'app_hangman_game_word')]
    public function word(WordRepository $wordRepository): Response
    {
        // Récupérer tous les mots de la base de données
        $words = $wordRepository->findAll();
        
        // Générer un nombre aléatoire
        $randomIndex = rand(0, count($words) - 1);
        
        // Récupérer le mot aléatoire
        $word = $words[$randomIndex];


    
    // Créer une réponse JSON avec le mot aléatoire 
    $response = new JsonResponse(['word' => $word->getword()]);

    // Ajouter un en-tête pour spécifier que la réponse est au format JSON
    $response->headers->set('Content-Type', 'application/json');

    // Retourner la réponse
    return $response;
}
#[Route('/hangman/game/updateScore', name: 'app_hangman_game_updateScore')]
public function updateScore(EntityManagerInterface $em, Request $request, TokenStorageInterface $tokenStorage): JsonResponse{
    $user = $tokenStorage->getToken()->getUser();
    $currentScore =   $user->getScore();
    $newScore = $request->get('score');
    $totalScore = $currentScore + $newScore;
    $user->setScore($totalScore);
    $em->persist($user);
    $em->flush();

    return new JsonResponse('Score updated successfully');
    }
}