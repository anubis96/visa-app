<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/profil', name: 'app_profile')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil/completer', name: 'app_profile_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a été mis à jour.');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/edit.html.twig', [
            'profileForm' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/profil/envoyer', name: 'app_profile_send', methods: ['POST'])]
    public function send(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$this->isCsrfTokenValid('send-profile-' . $user->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Jeton invalide, merci de réessayer.');

            return $this->redirectToRoute('app_profile');
        }

        if ($user->getTauxCompletion() < 100) {
            $this->addFlash('error', 'Votre profil doit être complété à 100% avant l\'envoi.');

            return $this->redirectToRoute('app_profile');
        }

        $user->setStatut(1);
        $user->setUpdatedAt(new \DateTimeImmutable());
        $entityManager->flush();

        $this->addFlash('success', 'Votre demande a été envoyée avec succès.');

        return $this->redirectToRoute('app_profile');
    }
}
