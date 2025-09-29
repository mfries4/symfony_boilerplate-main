<?php

namespace App\Controller;

use App\DataFixtures\Pain;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BurgerRepository; 
use App\Entity\Burger;
use App\Entity\Pain as EntityPain;
use Doctrine\ORM\EntityManagerInterface;

final class BurgerController extends AbstractController
{
    
    #[Route('/burger', name: 'burger_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $burgers = $entityManager->getRepository(Burger::class)->findAll();
        return $this->render('burger/burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }


    

    #[Route('/burgers/ingredient', name: 'burger_expensive')]
    public function burgersWithIngredient(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findBurgersWithIngredient(1, 1, 2);
        return $this->render('burger/burgers_with_ingredient.html.twig', [
            'burgers' => $burgers,
        ]);
    }

}
