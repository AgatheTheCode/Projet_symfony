<?php

namespace App\Controller;

//Classes
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;

//mes entités
use App\Entity\Categories;
use App\Entity\Produits;
use App\Entity\Genre;
use App\Entity\Client;
use App\Entity\LigneCommande;
use App\Entity\Commande;
use App\Entity\User;


class staticPage extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $entityManager): Response
    {

        //chargement du titre du site
        $index = [
            'titre' => 'Meganerd',
            'soustitre' => 'Un site qui à les cheveux gras',
            'logo' => 'image/logo.jpg'

        ];
        // Récupère le dépôt lié à la classe Castle
        $produits = $entityManager->getRepository(Produits::class)->findAll();
        $categorie = $entityManager->getRepository(Categories::class)->findAll();
        $genre = $entityManager->getRepository(Genre::class)->findAll();
        $titre = 'Home';

        dump($produits);

        return $this->render('home.html.twig', [
            'titre' => $titre,
            'produits' => $produits,
            'categorie' => $categorie,
            'genre' => $genre,
            'index' => $index
        ]);
    }

    /**
     * @Route("/categorie", name="categorie")
     */
    public function categorie(EntityManagerInterface $entityManager): Response
    {
        $titre = 'Categorie';
        $categorie = $entityManager->getRepository(Categories::class)->findAll();
$genre = $entityManager->getRepository(Genre::class)->findAll();




        return $this->render('pages/categorie.html.twig', [

            'titre' => $titre,
            'categorie' => $categorie,
            'genre' => $genre
        ]);
    }

    /**
     * @Route("/produit", name="produit")
     */
    public function produit(): Response
    {
        $titre = 'Produit';
        $produits = getAll('produit');

        $id = $_GET['id'] ?? null;

        return $this->render('pages/produit.html.twig', [
            'titre' => $titre,
            'produits' => $produits,
            'produit' => getOne('produit', 'id_categorie', $id)

        ]);
    }
    /**
     * @Route("/produitUnique", name="produitUnique")
     */
    public function produitUnique(): Response
    {
        $titre = 'Produit';
        $produits = getAll('produit');

        $id = $_GET['id'] ?? null;

        return $this->render('pages/produitUnique.html.twig', [
            'titre' => $titre,
            'produits' => $produits,
            'produit' => getOne('produit', 'id_produit', $id)

        ]);
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function panier(): Response
    {
        $titre = 'Panier';

        $id_produit = $_GET['id_produit'] ?? null;
        $id_client = $_GET['id_client'] ?? null;
        $quantite = $_GET['quantite'] ?? null;

        if ($id_produit && $id_client && $quantite) {
            insertPanier($id_produit, $id_client, $quantite);
        }

        return $this->render('pages/panier.html.twig', [
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        $titre = 'Contact';

        return $this->render('pages/contact.html.twig', [
            'titre' => $titre
        ]);
    }

    /**
     * @Route("categorie_detail", name="Categorie_detail")
     */
    public function categorie_detail(EntityManagerInterface $entityManager): Response
    {
        $id = $_GET['id'] ?? null;
        $titre = 'Categorie_detail';
        $produits = $entityManager->getRepository(Produits::class)->findAll();
        $categories = $entityManager->getRepository(Categories::class)->findBy(['id' => $id]);
        dump($produits);
        dump($categories);

        return $this->render('pages/categorie_detail.html.twig', [
            'titre' => $titre,
            'produits' => $produits,
            'categories' => $categories,
        ]);
    }
    /**
     * @Route("genre_detail", name="Genre_detail")
     */
    public function genre_detail(EntityManagerInterface $entityManager): Response
    {
        $id = $_GET['id'] ?? null;
        $titre = 'Genre_detail';
        $produits = $entityManager->getRepository(Produits::class)->findAll();
        $genres = $entityManager->getRepository(Genre::class)->findBy(['id' => $id]);
        dump($produits);
        dump($genres);

        return $this->render('pages/genre_detail.html.twig', [
            'titre' => $titre,
            'produits' => $produits,
            'genres' => $genres
        ]);
    }
    /**
     * @Route("inser", name="Insert")
     */

}
