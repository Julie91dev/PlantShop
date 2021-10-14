<?php

namespace App\Service\Categorie;

use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CategorieService
{
    protected $categorieRepository;
    protected $session;

    public function __construct(CategorieRepository $categorieRepository, SessionInterface $session){
        $this->categorieRepository = $categorieRepository;
        $this->session = $session;
    }

    public function getCategorie(): array
    {

        $categoriePlante = $this->categorieRepository->find(1);
        $categorieDecoration = $this->categorieRepository->find(2);
        $categorieOutil = $this->categorieRepository->find(3);

        $categ= [
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil
        ];
        $categorie = $this->session->get('categorie', []);
        if (!$this->session->has('categorie')) {
            $this->session->set('categorie', $categ);
        }
        $categorie = $this->session->get('categorie');

        return $categorie;
    }
}