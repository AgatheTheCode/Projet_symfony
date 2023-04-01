<?php

namespace App\Entity;

use App\Repository\LigneCommandeRepository;
<<<<<<< HEAD
use Doctrine\DBAL\Types\Types;
=======
>>>>>>> master
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneCommandeRepository::class)]
class LigneCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

<<<<<<< HEAD
    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id_produit = null;

    #[ORM\Column]
    private ?int $qte_commande = null;

=======
>>>>>>> master
    public function getId(): ?int
    {
        return $this->id;
    }
<<<<<<< HEAD

    public function getIdProduit(): ?string
    {
        return $this->id_produit;
    }

    public function setIdProduit(string $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getQteCommande(): ?int
    {
        return $this->qte_commande;
    }

    public function setQteCommande(int $qte_commande): self
    {
        $this->qte_commande = $qte_commande;

        return $this;
    }
=======
>>>>>>> master
}
