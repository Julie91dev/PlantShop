<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("personne:read")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Ajouter un numéro de téléphone")
     * @Assert\Type(type="integer", message="{{ value }} n'est pas un numéro de téléphone")
     * @Assert\Positive(message="{{ value }} n'est pas un numéro de téléphone. Une valeur positive est attendu")
     * @ORM\Column(type="integer")
     * @Groups("personne:read")
     */
    private $telephone;

    /**
     * @Assert\Positive(message="{{ value }} n'est pas un numéro de rue. Une valeur positive est attendu")
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("personne:read")
     */
    private $numero;

    /**
     * @Assert\NotBlank(message="Ajouter une rue")
     * @ORM\Column(type="string", length=255)
     * @Groups("personne:read")
     */
    private $rue;

    /**
     * @Assert\Type(type="integer", message="{{ value }} n'est pas un code postal")
     * @Assert\Positive(message="{{ value }} n'est pas un code postal. Une valeur positive est attendu")
     * @ORM\Column(type="integer")
     * @Groups("personne:read")
     */
    private $cp;

    /**
     * @Assert\NotBlank(message="La ville est nécessaire")
     * @Assert\Type(type="string", message="{{ value }} n'est pas une ville")
     * @Assert\Regex(pattern="/\d/", match=false, message="La ville ne peut pas contenir de nombre")
     * @ORM\Column(type="string", length=255)
     * @Groups("personne:read")
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="adresses")
     */
    private $client;

    /**
     * @Assert\Type(type="string", message="{{ value }} n'est pas un nom")
     * @Assert\NotBlank(message="Le nom est nécessaire")
     * @Assert\Length( min= 2, max= 35,
     *                 minMessage="Votre nom doit être supérieur à {{ limit }} caractères",
     *                 maxMessage="Votre nom doit être inférieur à {{ limit }} caractères")
     * @Assert\Regex(pattern="/\d/", match=false, message="Votre nom ne peut pas contenir de nombre")
     * @ORM\Column(type="string", length=255)
     * @Groups("personne:read")
     */
    private $nom;

    /**
     * @Assert\Type(type="string", message="{{ value }} n'est pas un prénom")
     * @Assert\NotBlank(message="Le prénom est nécessaire")
     * @Assert\Length( min= 2, max= 35,
     *                 minMessage="Votre prénom doit être supérieur à {{ limit }} caractères",
     *                 maxMessage="Votre prénom doit être inférieur à {{ limit }} caractères")
     * @Assert\Regex(pattern="/\d/", match=false, message="Votre prénom ne peut pas contenir de nombre")
     * @ORM\Column(type="string", length=255)
     * @Groups("personne:read")
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
}
