<?php

namespace App\Service\Panier;

use App\Repository\AdresseRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommandeRepository;
use App\Service\Commande\CommandeService;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class PanierService
{
    //TODO: Implémenter fonction
    protected $session;
    protected $articleRepository;
    protected $adresseRepository;
    protected $security;
    protected $commandeService;
    protected $commandeRepository;

    public function __construct(SessionInterface $session,
                                ArticleRepository $articleRepository,
                                AdresseRepository $adresseRepository,
                                Security $security,
                                CommandeService $commandeService,
                                CommandeRepository $commandeRepository)
    {
        $this->session = $session;
        $this->articleRepository = $articleRepository;
        $this->adresseRepository = $adresseRepository;
        $this->security = $security;
        $this->commandeService = $commandeService;
        $this->commandeRepository = $commandeRepository;
    }

    public function addPanier($id){
        $panier= $this->session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }
    public function removeQuantityPanier($id){
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])){
            if ($panier[$id] > 1){
                $panier[$id]--;
            }else {
                unset($panier[$id]);
            }
        }

        $this->session->set('panier', $panier);
    }
    public function deleteProduitPanier($id){
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])){
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);
    }
    public function getPanier()
    {
        $panier = $this->session->get('panier', []);
        $panierAvecData = [];


        foreach ($panier as $id => $quantite){

            $produit =  $this->articleRepository->find($id);
            $panierAvecData[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];

        }
        return $panierAvecData;
    }

    public function getTotalPanier()
    {
        $total= 0;

        foreach ($this->getPanier() as $produit) {
            $totalItem = $produit['produit']->getPrix() * $produit['quantite'];
            $total += $totalItem;
        }
        return $total;
    }

    public function livraison()
    {
        $adressesLivraison = [];

        $client = $this->security->getUser()->getId();
        $adresse = $this->adresseRepository->findLastAdress($client);
        $derniereAdresse = $this->adresseRepository->findLastAdress($client);
        $adresses = $this->adresseRepository->findBy(['client' => $client]);

        $adressesLivraison = [
            'adresse' => $adresse,
            'derniereAdresse' => $derniereAdresse,
            'adresses' => $adresses
        ];

        return $adressesLivraison;
    }

    public function setLivraisonOnSession($request)
    {
        if (!$this->session->has('adresse')){
            $this->session->set('adresse', []);

        }
        $adresse = $this->session->get('adresse');

        if ($request->get('livraison') != null && $request->get('facturation') != null ) {

            $adresse['livraison'] = $request->get('livraison');
            $adresse['facturation'] = $request->get('facturation');
        }
        $this->session->set('adresse', $adresse);

    }

    public function validerPanier($request)
    {

        $client =  $this->security->getUser()->getId();
        if ($request->getMethod() == 'POST') {
            $this->setLivraisonOnSession($request);
        }
        $prepareCommande = $this->commandeService->prepareCommande();

        //$commande = $this->commandeRepository->find($prepareCommande->getContent());
        $commande = $this->commandeRepository->find($prepareCommande);

        return $commande;
    }
}