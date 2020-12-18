<?php

namespace App\Form;

use App\Entity\Criticite;
use App\Entity\Salle;
use App\Entity\Ticket;
use App\Repository\CriticiteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreTicket', TextType::class,[
                'attr' => [
                    'class' => 'shadow mb-3'
                ]
            ])
            ->add('descriptionTicket', TextareaType::class,[
                'attr' => [
                    'class' => 'shadow mb-3'
                ]
            ])
            ->add('categorieTicket', ChoiceType::class,[
                'choices' => [
                    ' Menuiserie' => 'Menuiserie',
                    ' Électricité' => 'Électricité',
                    ' Informatique' => 'Informatique',
                    ' Petit bricolage' => "Petit bricolage",
                    ' Organisation' => 'Organisation',
                    ' Plomberie' => 'Plomberie'
                ],
                'attr' => [
                    'class' => 'shadow mb-3'
                ]
            ])

            ->add('salles', CollectionType::class,[
                'entry_type' => SalleType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true         
                ])


            ->add('materiels', CollectionType::class,[
                'entry_type' => MaterielType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true            
                ])

            ->add('criticite', ChoiceType::class, [
                    'choices'  => [
                        'Faible' => 1,
                        'Modéré' => 2,
                        'Critique' => 3,
                    ],
                ])

            // ->add('criticite', EntityType::class, [
            //         'class'       => Criticite::class,
            //         'choice_label' => 'nomCriticite',
            //       ])

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
            'data_class' => Ticket::class,
        ]);
    }
}
