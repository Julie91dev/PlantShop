<?php

namespace App\Service\Adresse;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class AdresseService
{
    //TODO: implémenter méthode
    protected $session;
    protected $adresseRepository;
    protected $security;
    protected $entityManager;

    public function __construct(SessionInterface $session,
                                AdresseRepository $adresseRepository,
                                Security $security,
                                EntityManagerInterface $entityManager)
    {
        $this->session = $session;
        $this->adresseRepository = $adresseRepository;
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function getAllAdresseByClient()
    {
        $client = $this->security->getUser()->getId();

        $adresses = $this->adresseRepository->findBy(['client' => $client]);

        return $adresses;
    }
    public function getAdresse()
    {

    }

    public function addAdresse()
    {

    }

}