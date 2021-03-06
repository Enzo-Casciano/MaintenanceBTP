<?php

namespace App\Form;

use App\Entity\Intervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriptionIntervention', TextareaType::class, [
                'attr' => [
                    'class' => ' shadow'
                ]
            ])

            ->add('descriptionRefus', TextareaType::class, [
                'attr' => [
                    'class' => ' shadow'
                ]
            ])

            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success shadow mb-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
