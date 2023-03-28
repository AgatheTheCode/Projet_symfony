<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class staticPage extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $titre = 'Bienvenue';

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
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/", name="produit")
     */
    public function produit(): Response
    {
        $titre = 'Produit';

        return $this->render('produit.html.twig', [
            'titre' => $titre
        ]);
    }

        /**
         * @Route("/", name="panier")
         */
        public function panier(): Response
        {
            $titre = 'Panier';

            return $this->render('panier.html.twig', [
                'titre' => $titre
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