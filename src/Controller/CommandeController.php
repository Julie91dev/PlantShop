<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Service\Commande\CommandeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * Permet de faire appel a un service pour enregistrer la commande en base de donnée
     * @param CommandeService $commandeService
     * @return Response
     */
    public function prepareCommande(CommandeService $commandeService)
    {
        $commande = $commandeService->prepareCommande();
        return new Response($commande->getId());
    }


    /**
     * Cette méthode remplace l'api banque
     * @param int $id
     * @param CommandeRepository $commandeRepository
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/commande/validation/{id}", name="commande_validation")
     */
    public function validationCommande(int $id, CommandeService $commandeService, MailerInterface $mailer)
    {
            $commandeService->validationCommande($id);
            $this->addFlash('success', 'Votre commande est validée avec succès');
            $email = (new Email())
                    ->from('account@plantshop.fr')
                    ->to($this->getUser()->getUserIdentifier())
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

}
