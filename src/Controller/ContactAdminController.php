<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Entity\ContactAdmin;
use App\Form\ContactAdminType;
use App\Repository\ContactAdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/contact/admin')]
class ContactAdminController extends AbstractController
{

    #[Route('/{page<\d+>?1}', name: 'app_contact_admin')]
    public function index($page, ContactRepository $contactRepository): Response
    {
        $mails_per_page = 10;
        $mails = $contactRepository-> findForPagination($page, $mails_per_page);
        $totalPages = ceil($contactRepository->count([]) / $mails_per_page);
    
        return $this->render('contact_admin/index.html.twig', [
            'controller_name' => 'ContactAdminController',
            'mails' => $mails,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ]);
    }
    #[Route('/new', name: 'app_contact_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContactAdminRepository $contactAdminRepository): Response
    {
        $contactAdmin = new ContactAdmin();
        $form = $this->createForm(ContactAdminType::class, $contactAdmin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactAdminRepository->save($contactAdmin, true);

            return $this->redirectToRoute('app_contact_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_admin/new.html.twig', [
            'contact_admin' => $contactAdmin,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'app_contact_admin_show', methods: ['GET'])]
    public function show(ContactRepository $contactRepository,$id): Response
    {
        $mailsByUser= $contactRepository-> findByUser($id);
        return $this->render('contact_admin/show.html.twig', [
            'mails_by_user' => $mailsByUser,
        ]);
    }
    #[Route('/{id}/mark-as-read', name: 'app_contact_admin_mark_as_read', methods: ['POST'])]
    public function markAsRead(Contact $contact, ContactRepository $contactRepository): JsonResponse
    {
        $contact->setIsRead(true);
        $contactRepository->save($contact, true);

        return new JsonResponse(['is_read' => $contact->getIsRead()]);
    }


    #[Route('/{id}/edit', name: 'app_contact_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactAdmin $contactAdmin, ContactAdminRepository $contactAdminRepository): Response
    {
        $form = $this->createForm(ContactAdminType::class, $contactAdmin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactAdminRepository->save($contactAdmin, true);

            return $this->redirectToRoute('app_contact_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_admin/edit.html.twig', [
            'contact_admin' => $contactAdmin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_admin_delete', methods: ['POST'])]
    public function delete(Request $request, ContactAdmin $contactAdmin, ContactAdminRepository $contactAdminRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactAdmin->getId(), $request->request->get('_token'))) {
            $contactAdminRepository->remove($contactAdmin, true);
        }

        return $this->redirectToRoute('app_contact_admin_index', [], Response::HTTP_SEE_OTHER);
    }


}
