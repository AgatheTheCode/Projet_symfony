<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
<<<<<<< HEAD
use Doctrine\DBAL\Types\Types;
=======
>>>>>>> master
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

<<<<<<< HEAD
    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id_prod = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id_client = null;

    #[ORM\Column]
    private ?int $qte_produit = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_commande = null;

=======
>>>>>>> master
    public function getId(): ?int
    {
        return $this->id;
    }
<<<<<<< HEAD

    public function getIdProd(): ?string
    {
        return $this->id_prod;
    }

    public function setIdProd(string $id_prod): self
    {
        $this->id_prod = $id_prod;

        return $this;
    }

    public function getIdClient(): ?string
    {
        return $this->id_client;
    }

    public function setIdClient(string $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getQteProduit(): ?int
    {
        return $this->qte_produit;
    }

    public function setQteProduit(int $qte_produit): self
    {
        $this->qte_produit = $qte_produit;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;

        return $this;
    }
=======
>>>>>>> master
}
