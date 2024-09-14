<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireFormType;
use App\Repository\CoursRepository;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    #[Route('/cours', name: 'app_cours_index')]
    public function index(CoursRepository $coursRepository, CommentaireRepository $commentaireRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer un cours particulier avec ID fixe (par exemple id = 1)
        $cours = $coursRepository->find(1); // Ou un autre ID selon vos besoins

        if (!$cours) {
            throw $this->createNotFoundException('Le cours demandé n\'existe pas.');
        }

        // Récupérer les commentaires associés au cours
        $commentaires = $commentaireRepository->findBy(['cours' => $cours]);

        // Formulaire pour ajouter un commentaire
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireFormType::class, $commentaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setCours($cours);
            $commentaire->setUtilisateur($this->getUser());
            $commentaire->setDateCommentaire(new \DateTimeImmutable()); // Définir la date actuelle

            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_cours_index');
        }

        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
            'commentaires' => $commentaires,
            'form' => $form->createView(),
        ]);
    }
}
