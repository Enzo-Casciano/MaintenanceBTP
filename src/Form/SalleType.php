<?php

namespace App\Form;

use App\Entity\Salle;
use App\Entity\Zone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroSalle', ChoiceType::class,[
                'choices' => [
                    'Rez-de-chaussée' => [
                        'Zone 1' => [
                            ' Salle 4' => 'Salle 4',
                            ' Salle 5' => 'Salle 5',
                            ' Salle 6' => 'Salle 6',
                            ' Salle 7' => 'Salle 7',
                            ' Salle 24' => 'Salle 24',
                            ' Salle 25' => 'Salle 25',
                            ' Salle 26' => 'Salle 26',
                            ' Salle 29' => 'Salle 29',
                            ' Salle 30' => 'Salle 30',
                            ' Salle 37' => 'Salle 37'
                        ],
                        'Zone 2' => [
                            ' Salle 31' => 'Salle 31',
                            ' Salle 32' => 'Salle 32',
                            ' Salle 33a' => 'Salle 33a',
                            ' Salle 33b' => 'Salle 33b',
                            ' Salle 34' => 'Salle 34',
                            ' Salle 35' => 'Salle 35',
                            ' Salle 36' => 'Salle 36',
                            ' Salle 39' => 'Salle 39'
                        ],
                        'Zone 3' => [
                            ' Salle 8' => 'Salle 8',
                            ' Salle 9' => 'Salle 9',
                            ' Salle 10' => 'Salle 10',
                            ' Salle 11' => 'Salle 11',
                            ' Salle 12' => 'Salle 12',
                            ' Salle 13' => 'Salle 13'
                        ],
                        'Zone 4' => [
                            ' Salle 17' => 'Salle 17',
                            ' Salle 18' => 'Salle 18',
                            ' Salle 19' => 'Salle 19',
                            ' Salle 20' => 'Salle 20',
                            ' Salle 21' => 'Salle 21',
                            ' Salle 22' => 'Salle 22',
                            ' Salle 23' => 'Salle 23'
                        ],
                        'Zone 5' => [
                            ' Salle 106' => 'Salle 106',
                            ' Salle 107' => 'Salle 107',
                            ' Salle 108' => 'Salle 108',
                            ' Salle 109' => 'Salle 109',
                            ' Salle 110' => 'Salle 110',
                            ' Salle 111' => 'Salle 111',
                            ' Salle 112' => 'Salle 112',
                            ' Salle 113' => 'Salle 113',
                            ' Salle 114' => 'Salle 114'
                        ],
                    ],
                    'Étage' => [
                        'Zone 1' => [
                            ' Salle 4' => 'Salle 4',
                            ' Salle 42' => 'Salle 42',
                            ' Salle 43' => 'Salle 43',
                            ' Salle 62' => 'Salle 62',
                            ' Salle 63' => 'Salle 63',
                            ' Salle 64' => 'Salle 64',
                            ' Salle 65' => 'Salle 65',
                            ' Salle 66' => 'Salle 66',
                            ' Salle 67' => 'Salle 67',
                            ' Salle 70' => 'Salle 70',
                            ' Salle 71' => 'Salle 71'
                        ],
                        'Zone 2' => [
                            ' Salle 72' => 'Salle 72',
                            ' Salle 73' => 'Salle 73',
                            ' Salle 74' => 'Salle 74',
                            ' Salle 75' => 'Salle 75',
                            ' Salle 76' => 'Salle 76',
                            ' Salle 81' => 'Salle 81'
                        ],
                        'Zone 3' => [
                            ' Salle 44' => 'Salle 44',
                            ' Salle 45' => 'Salle 45',
                            ' Salle 46' => 'Salle 46',
                            ' Salle 47' => 'Salle 47',
                            ' Salle 48' => 'Salle 48',
                            ' Salle 49' => 'Salle 49',
                            ' Salle 50' => 'Salle 50',
                            ' Salle 51' => 'Salle 51',
                            ' Salle 52' => 'Salle 52'
                        ],
                        'Zone 4' => [
                            ' Salle 54' => 'Salle 54',
                            ' Salle 55' => 'Salle 55',
                            ' Salle 56' => 'Salle 56',
                            ' Salle 57' => 'Salle 57',
                            ' Salle 58' => 'Salle 58',
                            ' Salle 59' => 'Salle 59',
                            ' Salle 60' => 'Salle 60'
                        ],
                        'Zone 5' => [
                            ' Salle 100' => 'Salle 100',
                            ' Salle 101' => 'Salle 101',
                            ' Salle 104' => 'Salle 104',
                            ' Salle 105' => 'Salle 105'
                        ],
                    ],
                ],
                'attr' => [
                    'class' => 'shadow mb-3'
                ],
                'empty_data' => 'Erreur'
            ])

            ->add('zones', CollectionType::class,[
                'entry_type' => ZoneType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true        
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salle::class,
        ]);
    }
}
