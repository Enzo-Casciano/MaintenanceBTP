<?php

namespace App\Form;

use App\Entity\Niveau;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NiveauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomNiveau', EntityType::class, [
                'class' => Niveau::class,
                'attr' => [
                    'class' => 'btn btn-secondary dropdown-toggle shadow' 
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Niveau::class,
        ]);
    }
}
