<?php

namespace App\Service\Commande;

use App\Entity\Commande;
use App\Repository\AdresseRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class CommandeService
{

    protected $session;
    protected $adresseRepository;
    protected $articleRepository;
    protected $commandeRepository;
    protected $entityManager;
    protected $security;
    protected $userRepository;

    public function __construct(SessionInterface $session,
                                AdresseRepository $adresseRepository,
                                ArticleRepository $articleRepository,
                                CommandeRepository $commandeRepository,
                                EntityManagerInterface $entityManager,
                                Security $security,
                                UserRepository $userRepository)
    {
        $this->session = $session;
        $this->adresseRepository = $adresseRepository;
        $this->articleRepository = $articleRepository;
        $this->commandeRepository = $commandeRepository;
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->userRepository = $userRepository;
    }

    /**
     * Validation de la commande
     * @param $id
     */
    public function validationCommande($id)
    {
        $commande = $this->commandeRepository->find($id);

       if (!$commande || $commande->getValider() == 1){
            throw new \Exception('La commande n\'existe pas');
           // throw $this->createNotFoundException('La commande n\'existe pas');
        }

        $commande->setValider(1);
        $commande->setReference($this->reference());
        $this->entityManager->flush();

        $this->session->remove('panier');
        $this->session->remove('adresse');
        $this->session->remove('commande');

    }

    /**
     * Création d'un tableau multidimentionnel "Commande" afin de récupérer toutes les informations nécessaire a l'etablissement d'une facture
     * @return array
     * @throws \Exception
     */
    public function facture()
    {
        $token = bin2hex(random_bytes(20));
        $adresse = $this->session->get('adresse');
        $panier = $this->session->get('panier');
        $commande = [];
        $total = 0;

        $facturation = $this->adresseRepository->find($adresse['facturation']);
        $livraison = $this->adresseRepository->find($adresse['livraison']);
        $produits = [];
        $panier = $this->session->get('panier');
        foreach ($panier as $id => $quantite) {

            $produit =  $this->articleRepository->find($id);
            $produits[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];

           // $prix = $produits[$produit->getId()]->getPrix() * $quantite;
            $prix = $produit->getPrix() * $quantite;
            $total += $prix;

            $commande['produit'][$produit->getId()] = ['reference' => $produit->getNom(),
                'quantite' => $quantite,
                'prix' => $produit->getPrix(),
                'categorie' => $produit->getCategorie()->getNom(),
                'images' => $produit->getImages()
            ];


        }

        $commande['livraison'] = [  'prenom' => $livraison->getPrenom(),
            'nom' => $livraison->getNom(),
            'telephone' => $livraison->getTelephone(),
            'numero' => $livraison->getNumero(),
            'rue' => $livraison->getRue(),
            'cp' => $livraison->getCp(),
            'ville' => $livraison->getVille()
        ];

        $commande['facturation'] = [    'prenom' => $facturation->getPrenom(),
            'nom' => $facturation->getNom(),
            'telephone' => $facturation->getTelephone(),
            'numero' => $facturation->getNumero(),
            'rue' => $facturation->getRue(),
            'cp' => $facturation->getCp(),
            'ville' => $facturation->getVille()
        ];

        $commande['prix'] = $total;
        $commande['token'] = $token;

        return $commande;
    }

    /**
     * Permet d'enregistrer la commande en base de donnée
     * @return Commande|null
     *
     */
    public function prepareCommande()
    {
        if (!$this->session->has('commande')){
            $commande = new Commande();
        }else{
            $commande = $this->commandeRepository->find($this->session->get('commande'));
        }

        $emailUser = $this->security->getUser()->getUserIdentifier();
        $user = $this->userRepository->findOneBy(['email' => $emailUser]);

        $commande->setDate(new \DateTime());
        $commande->setClient($user);
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture());

        if (!$this->session->has('commande')){
            $this->entityManager->persist($commande);
            $this->session->set('commande', $commande);
        }

        $this->entityManager->flush();
        return $commande;

    }

    /**
     * Permet d'incrémenter automatiquement la variable référence
     * @return int|string|null
     */
    public function reference()
    {
        $reference = $this->commandeRepository->findOneBy(array('valider' => 1), array('id' => 'DESC'),1,1);

        if (!$reference)
            return 1;
        else
            return $reference->getReference() +1;
    }
}