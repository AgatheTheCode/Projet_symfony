<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

include_once ('../include/function.php');
include_once ('../include/user.php');


class staticPage extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $titre = 'Home';

        return $this->render('home.html.twig', [
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/", name="categorie")
     */
    public function categorie(): Response
    {
        $titre = 'Catégorie';

        return $this->render('categorie.html.twig', [
            'titre' => $titre,
            'categories' => getAll('categorie')
        ]);
    }

    /**
     * @Route("/", name="produit")
     */
    public function produit(): Response
    {
        $titre = 'Produit';

        return $this->render('produit.html.twig', [
            'titre' => $titre,
            'produits' => getOne('produit', 'id_categorie', $_GET['id'])

        ]);
    }

    /**
     * @Route("/", name="panier")
     */
    public function panier(): Response
    {
        $titre = 'Panier';

        return $this->render('panier.html.twig', [
            'titre' => $titre,
            'panier' => insertPanier($_GET['id_produit'], $_GET['id_client'], $_GET['quantite'])
        ]);
    }

    /**
     * @Route("/", name="contact")
     */
    public function contact(): Response
    {
        $titre = 'Contact';

        return $this->render('contact.html.twig', [
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/", name="login")
     */
    public function login(): Response
    {
        $titre = 'Login';

        return $this->render('login.html.twig', [
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/", name="register")
     */
    public function register(): Response
    {
        $titre = 'Register';

        return $this->render('register.html.twig', [
            'titre' => $titre
        ]);
    }
}