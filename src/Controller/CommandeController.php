<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\AdresseRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommandeRepository;
use App\Service\Commande\CommandeService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class CommandeController extends AbstractController
{
  /*  /**
     * @throws Exception
     */
   /* public function facture(SessionInterface $session,
                            AdresseRepository $adresseRepository,
                            ArticleRepository $articleRepository)
    {
        $token = bin2hex(random_bytes(20));
        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $commande = [];
        $total = 0;

        $facturation = $adresseRepository->find($adresse['facturation']);
        $livraison = $adresseRepository->find($adresse['livraison']);
        $produits = [];
        $panier = $session->get('panier');
        foreach ($panier as $id => $quantite) {

            $produit =  $articleRepository->find($id);
            $produits[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];

            $prix = $produits[$produit->getId()]->getPrix() * $quantite;
            $total += $prix;

            $commande['produit'][$produit->getId()] = ['reference' => $produit->getNom(),
                                                        'quantite' => $quantite,
                                                        'prix' => $produit->getPrix(),
                                                        'categorie' => $produit->getCategorie()->getNom(),
                                                        'image' => $produit->getImages()
            ];

            dump("tableau de produits");
            dump($produits);
            dump($prix);*/



            /*foreach ($produits as $produit)
            {
                dump("boucle sur le tableau de produit");
                $prix = ($produit->getPrix() * $quantite);
                $total += $prix;

                $commande['produit'][$produit->getId()] = ['reference' => $produit->getNom(),
                    'quantite' => $quantite,
                    'prix' => $produit->getPrix()
                ];
                dump("verification du tableau commande");
                dump($commande);
            }*/
      /*  }
        dump("verification du tableau commande");
        dump($commande);*/
       /* foreach ($produits as $produit)
        {
            dump("produit");
            dump($produit);
            dump("panier");
            dump($panier[$produit->getId()]);
            die();
            $prix = ($produit->getPrix() * $panier[$produit->getId()]);
            $total += $prix;

            $commande['produit'][$produit->getId()] = ['reference' => $produit->getNom(),
                                                        'quantite' => $panier[$produit->getId()],
                                                        'prix' => $produit->getPrix()
            ];
        }*/

       /* $commande['livraison'] = [  'prenom' => $livraison->getPrenom(),
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
    }*/


    public function prepareCommande(CommandeService $commandeService)
    {
       /* if (!$session->has('commande')){
            $commande = new Commande();
        }else{
            $commande = $commandeRepository->find($session->get('commande'));
        }

        $commande->setDate(new \DateTime());
        $commande->setClient($this->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture($session, $adresseRepository, $articleRepository ));

        if (!$session->has('commande')){
            $entityManager->persist($commande);
            $session->set('commande', $commande);
        }

        $entityManager->flush();*/
        $commande = $commandeService->prepareCommande();
        return new Response($commande->getId());
    }
    /*
     * Cette méthode remplace l'api banque
     */
    /**
     * @param int $id
     * @param CommandeRepository $commandeRepository
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/commande/validation/{id}", name="commande_validation")
     */
    public function validationCommande(int $id, CommandeService $commandeService, MailerInterface $mailer)
    {
           /* $commande = $commandeRepository->find($id);

            if (!$commande || $commande->getValider() == 1){
                throw $this->createNotFoundException('La commande n\'existe pas');
            }

            $commande->setValider(1);
            $commande->setReference(1);
            $entityManager->flush();

            $session->remove('panier');
            $session->remove('adresse');
            $session->remove('commande');*/

            $commandeService->validationCommande($id);
            $this->addFlash('success', 'Votre commande est validée avec succès');
            $email = (new Email())
                    ->from('account@plantshop.fr')
                    ->to($this->getUser()->getUserIdentifier())
                    //->cc('cc@example.com')
                    //->bcc('bcc@example.com')
                    //->replyTo('fabien@example.com')
                    //->priority(Email::PRIORITY_HIGH)
                    ->subject('Votre commande PlantShop')
                    ->text('Confirmation de votre commande')
                    ->html('<p>Votre commande a été prise en compte</p>');
            try{
                $mailer->send($email);
            }catch (TransportExceptionInterface $e){
                $e->getMessage();
            }


            return $this->redirectToRoute("profile_facture");

    }

    /**
     * @Route("/profile/commande", name="commande")
     */
  /*  public function index(): Response
    {
        return $this->render('user/commande/facture.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }*/
}
