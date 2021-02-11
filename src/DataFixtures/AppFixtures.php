<?php

namespace App\DataFixtures;

use App\Entity\Intervention;
use App\Entity\Materiel;
use App\Entity\Niveau;
use App\Entity\Salle;
use App\Entity\Statut;
use App\Entity\Ticket;
use Faker;
use App\Entity\Utilisateur;
use App\Entity\Zone;
use App\Repository\StatutRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $userAdmin = new Utilisateur();
        $userAdmin->setNomUtilisateur("Admin");
        $userAdmin->setPrenomUtilisateur("Admin");
        $userAdmin->setEmail("admin@viacesi.fr");
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setPassword($this->passwordEncoder->encodePassword($userAdmin,'P@ssword'));
        $manager->persist($userAdmin);

        $user = [];
        for ($i = 0; $i < 10; $i++) {
            $user[$i] = new Utilisateur();
            $user[$i]->setNomUtilisateur($faker->lastName);
            $user[$i]->setPrenomUtilisateur($faker->firstName('male'|'female'));
            $user[$i]->setEmail($faker->freeEmail);
            $user[$i]->setRoles([]);
            $user[$i]->setPassword($this->passwordEncoder->encodePassword($user[$i],'P@ssword'));
            $manager->persist($user[$i]);
        }

        $statutDefault = new Statut();
        $statutDefault->setNomStatut("En attente");
        $manager->persist($statutDefault);

        $statut = new Statut();
        $statut->setNomStatut("Validé");
        $manager->persist($statut);

        $statut = new Statut();
        $statut->setNomStatut("Résolue");
        $manager->persist($statut);

        $statut = new Statut();
        $statut->setNomStatut("Refusé");
        $manager->persist($statut);

        $ticket = [];
        for ($i = 0; $i < 50; $i++){

            $materiel[$i] = new Materiel();
            $materiel[$i]->setNomMateriel($faker->word);
            $manager->persist($materiel[$i]);

            $niveau[$i] = new Niveau();
            $niveau[$i]->setNomNiveau("Rez-de-chaussé");
            $manager->persist($niveau[$i]);
            
                $zone[$i] = new Zone();
                $zone[$i]->setNomZone("Zone 1");
                $zone[$i]->addNiveau($niveau[$i]);
                $manager->persist($zone[$i]);
                
                    $salle[$i] = new Salle();
                    $salle[$i]->setNumeroSalle("Salle 24");
                    $salle[$i]->addZone($zone[$i]);
                    $manager->persist($salle[$i]);
                

            $ticket[$i] = new Ticket();
            $ticket[$i]->setTitreTicket($faker->sentence($nbWords = 3, $variableNbWords = true));
            $ticket[$i]->setDescriptionTicket($faker->paragraph($nbSentences = 2, $variableNbSentences = true));
            $ticket[$i]->setDateTicket($faker->dateTimeBetween($startDate = '-3 month', $endDate = '+ 1 day'));
            $ticket[$i]->setCategorieTicket($faker->word);
            $ticket[$i]->setUtilisateur($userAdmin);
            $ticket[$i]->setStatut($statutDefault);
            $ticket[$i]->addMateriel($materiel[$i]);
            $ticket[$i]->addSalle($salle[$i]);

            $manager->persist($ticket[$i]);
        }
        $manager->flush();
    }
}
