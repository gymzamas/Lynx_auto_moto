<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use App\Entity\Utilisateur;
use App\Entity\Cours;
use App\Entity\Commentaire;

class AdminDashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Redirige vers le CRUD des utilisateurs
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UtilisateurCrudController::class)->generateUrl());
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Cours', 'fas fa-book', Cours::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comments', Commentaire::class);
    }
}