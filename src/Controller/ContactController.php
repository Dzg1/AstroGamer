<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // création d'une nouvelle instance de l'entité Contact
        $contact = new Contact();

        // Récupération de l'utilisateur connecté
        $user = $this->getUser();

        // Attribution des valeurs de l'utilisateur aux propriétés de contact
      
        $contact->setUsername($user->getUserIdentifier()); 
        $contact->setEmail($user->getEmail());
    

      // création du formulaire à partir de ContactType
      $form = $this->createForm(ContactType::class, $contact, [
        'remove_fields' => ['username', 'email'] // Retirer les champs "username" et "email" du formulaire
    ]);


        // traitement de la soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // enregistrement de l'entité Contact en base de données
            $entityManager->persist($contact);
            $entityManager->flush();

            // redirection vers la page de confirmation
            return $this->redirectToRoute('app_home');
        }

        // affichage du formulaire
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
