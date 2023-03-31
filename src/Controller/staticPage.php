<?php

namespace App\Controller;

use App\Helper\UserClass;
use Cassandra\Type\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\RegistrationFormType;
use App\helper\User;

use function Sodium\add;

require_once __DIR__ . '/../include/function.php';


class staticPage extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {

        $index = [
            'titre' => 'Meganerd',
            'soustitre' => 'Un site qui à les cheveux gras',
            'logo' => 'image/logo.jpg'

        ];
        $titre = 'Home';
        $produit = getAll('produit');

        return $this->render('home.html.twig', [
            'titre' => $titre,
            'produit' => $produit,
            'index' => $index
        ]);
    }

    /**
     * @Route("/categorie", name="categorie")
     */
    public function categorie(): Response
    {
        $titre = 'Catégorie';
        $categorie = getAll('categorie');
        $totalcat = count($categorie);
        $stockCat = stockType('categorie');
        $stockGenre = stockType('genre');
        $stockUnique = stockProduit('id_produit');
        $genre = getAll('genre');


        return $this->render('categorie.html.twig', [

            'titre' => $titre,
            'categorie' => $categorie,
            'totalcat' => $totalcat,
            'stockCat' => $stockCat,
            'stockGenre' => $stockGenre,
            'stockUnique' => $stockUnique,
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

        return $this->render('produit.html.twig', [
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

        return $this->render('produitUnique.html.twig', [
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

        return $this->render('panier.html.twig', [
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        $titre = 'Contact';

        return $this->render('contact.html.twig', [
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        $titre = 'Login';

        return $this->render('login.html.twig', [
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/register", name="register")
     **/
    Public function register(): Response
    {
        $titre = 'Register';
        /*p$user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('register.html.twig', [
            'titre' => $titre,
            'form' => $form->createView(),
        ]);*/
    }
}
