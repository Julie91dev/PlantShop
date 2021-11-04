<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    protected $commandeRepository;
    protected $userRepository;
    protected $articleRepository;
    public function __construct(CommandeRepository $commandeRepository,
                                UserRepository $userRepository,
                                ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
        $this->commandeRepository = $commandeRepository;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'countAllCommande' => $this->commandeRepository->countAllCommandes(),
            'commandesDuJour' => $this->commandeRepository->getCommandesToday(),
            'countCommandesToday' => $this->commandeRepository->countCommandesToday()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PlantShop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Sous categories', 'fa fa-sticky-note', SousCategorie::class);
         yield MenuItem::linkToCrud('Categories', 'fa fa-sticky-note-o', Categorie::class);
         yield MenuItem::linkToCrud('Articles', '	fa fa-shopping-basket', Article::class);
         yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
    }
}
