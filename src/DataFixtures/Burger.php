<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Burger extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création du pain
        $pain = new \App\Entity\Pain();
        $pain->setName('Pain brioché');
        $manager->persist($pain);

        // Création des oignons
        $oignon1 = new \App\Entity\Oignon();
        $oignon1->setName('Oignon rouge');
        $manager->persist($oignon1);

        $oignon2 = new \App\Entity\Oignon();
        $oignon2->setName('Oignon blanc');
        $manager->persist($oignon2);

        // Création des sauces
        $sauce1 = new \App\Entity\Sauce();
        $sauce1->setName('Mayonnaise');
        $manager->persist($sauce1);

        $sauce2 = new \App\Entity\Sauce();
        $sauce2->setName('Ketchup');
        $manager->persist($sauce2);

        // Création de l'image
        $image = new \App\Entity\Image();
        $image->setName('krabby-patty.jpg');
        $manager->persist($image);

    // Burger 1
    $burger1 = new \App\Entity\Burger();
    $burger1->setName('Krabby Patty');
    $burger1->setPrice(4.99);
    $burger1->setPain($pain);
    $burger1->addOignon($oignon1);
    $burger1->addOignon($oignon2);
    $burger1->addSauce($sauce1);
    $burger1->addSauce($sauce2);
    $burger1->setImage($image);
    $manager->persist($burger1);

    // Burger 2
    $pain2 = new \App\Entity\Pain();
    $pain2->setName('Pain complet');
    $manager->persist($pain2);
    $oignon3 = new \App\Entity\Oignon();
    $oignon3->setName('Oignon frit');
    $manager->persist($oignon3);
    $sauce3 = new \App\Entity\Sauce();
    $sauce3->setName('Barbecue');
    $manager->persist($sauce3);
    $image2 = new \App\Entity\Image();
    $image2->setName('bacon-burger.jpg');
    $manager->persist($image2);
    $burger2 = new \App\Entity\Burger();
    $burger2->setName('Bacon Burger');
    $burger2->setPrice(6.50);
    $burger2->setPain($pain2);
    $burger2->addOignon($oignon3);
    $burger2->addSauce($sauce3);
    $burger2->setImage($image2);
    $manager->persist($burger2);

    // Burger 3
    $pain3 = new \App\Entity\Pain();
    $pain3->setName('Pain sésame');
    $manager->persist($pain3);
    $sauce4 = new \App\Entity\Sauce();
    $sauce4->setName('Moutarde');
    $manager->persist($sauce4);
    $image3 = new \App\Entity\Image();
    $image3->setName('veggie-burger.jpg');
    $manager->persist($image3);
    $burger3 = new \App\Entity\Burger();
    $burger3->setName('Veggie Burger');
    $burger3->setPrice(5.90);
    $burger3->setPain($pain3);
    $burger3->addSauce($sauce4);
    $burger3->setImage($image3);
    $manager->persist($burger3);

    $manager->flush();
    }
}
