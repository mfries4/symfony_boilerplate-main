<?php

namespace App\Form;

use App\Entity\Pain;
use App\Entity\Image;
use App\Entity\Sauce;
use App\Entity\Burger;
use App\Entity\Oignon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BurgerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom : '])
            ->add('price', TextType::class, ['label' => 'Prix : '])
            ->add('pain', EntityType::class, [
                'class' => Pain::class,
                'choice_label' => 'name',
                'label' => 'Pain : '
            ])
            ->add('oignon', EntityType::class, [
                'class' => Oignon::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Oignon : '
            ])
            ->add('sauce', EntityType::class, [
                'class' => Sauce::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Sauce : '
            ])
            ->add('image', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'name',
                'label' => 'Image : '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Burger::class,
        ]);
    }
}
