<?php

namespace App\Controller;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactAdminController extends AbstractController
{
    #[Route('/contact/admin/{page<\d+>?1}', name: 'app_contact_admin')]
    public function index($page, ContactRepository $contactRepository): Response
    {
        $mails_per_page = 2;
        $mails = $contactRepository-> findForPagination($page, $mails_per_page);
        $totalPages = ceil($contactRepository->count([]) / $mails_per_page);
    
        return $this->render('contact_admin/index.html.twig', [
            'controller_name' => 'ContactAdminController',
            'mails' => $mails,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ]);
    }
    
}
