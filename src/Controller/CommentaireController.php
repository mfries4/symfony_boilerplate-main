<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;


final class CommentaireController extends AbstractController
{

    #[Route('/commentaires', name: 'commentaire_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $commentaires = $entityManager->getRepository(Commentaire::class)->findAll();
        return $this->render('commentaire/commentaires_list.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }

    #[Route('/commentaire/create', name: 'commentaire_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setName('Commentaire rouge');

        // Persister et sauvegarder l'commentaire
        $entityManager->persist($commentaire);
        $entityManager->flush();

        return new Response('Commentaire créé avec succès !');
    }
}
