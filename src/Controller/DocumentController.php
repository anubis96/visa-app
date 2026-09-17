<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\User;
use App\Form\DocumentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class DocumentController extends AbstractController
{
    #[Route('/documents', name: 'app_document_list')]
    public function list(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('document/list.html.twig', [
            'documents' => $user->getDocuments(),
        ]);
    }

    #[Route('/documents/ajouter', name: 'app_document_upload')]
    public function upload(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $document = new Document();
        $document->setUser($user);

        $form = $this->createForm(DocumentFormType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($document);
            $entityManager->flush();

            $this->addFlash('success', sprintf('Le document "%s" a été envoyé avec succès.', $document->getCategorieLabel()));

            return $this->redirectToRoute('app_document_list');
        }

        return $this->render('document/upload.html.twig', [
            'documentForm' => $form,
        ]);
    }

    #[Route('/documents/{id}/supprimer', name: 'app_document_delete', methods: ['POST'])]
    public function delete(Request $request, Document $document, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($document->getUser() !== $user) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete-document-' . $document->getId(), $request->request->get('_token'))) {
            $entityManager->remove($document);
            $entityManager->flush();
            $this->addFlash('success', 'Document supprimé.');
        }

        return $this->redirectToRoute('app_document_list');
    }
}
