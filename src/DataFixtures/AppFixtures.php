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

        $materiel1 = new Materiel();
        $materiel1->setNomMateriel("Ordinateur");
        $manager->persist($materiel1);

        $materiel2 = new Materiel();
        $materiel2->setNomMateriel("Porte");
        $manager->persist($materiel2);

        $materiel3 = new Materiel();
        $materiel3->setNomMateriel("Table");
        $manager->persist($materiel3);

        $materiel4 = new Materiel();
        $materiel4->setNomMateriel("Toilette");
        $manager->persist($materiel4);

        $niveau1 = new Niveau();
        $niveau1->setNomNiveau("Rez-de-chaussé");
        $manager->persist($niveau1); 

        $niveau2 = new Niveau();
        $niveau2->setNomNiveau("Étage");
        $manager->persist($niveau2); 

        $zone1 = new Zone();
        $zone1->setNomZone("Zone 1");
        $zone1->addNiveau($niveau1);
        $manager->persist($zone1);

        $zone2 = new Zone();
        $zone2->setNomZone("Zone 3");
        $zone2->addNiveau($niveau2);
        $manager->persist($zone2);

        $zone3 = new Zone();
        $zone3->setNomZone("Zone 2");
        $zone3->addNiveau($niveau1);
        $manager->persist($zone3);

        $zone4 = new Zone();
        $zone4->setNomZone("Zone 4");
        $zone4->addNiveau($niveau2);
        $manager->persist($zone4);

        $salle1 = new Salle();
        $salle1->setNumeroSalle("Salle 24");
        $salle1->addZone($zone1);
        $manager->persist($salle1);

        $salle2 = new Salle();
        $salle2->setNumeroSalle("Salle 49");
        $salle2->addZone($zone2);
        $manager->persist($salle2);

        $salle3 = new Salle();
        $salle3->setNumeroSalle("Salle 33b");
        $salle3->addZone($zone3);
        $manager->persist($salle3);

        $salle4 = new Salle();
        $salle4->setNumeroSalle("Salle 57");
        $salle4->addZone($zone4);
        $manager->persist($salle4);

        $ticket = [];
        for ($i = 0; $i < 20; $i++){
            $ticket[$i] = new Ticket();
            $ticket[$i]->setTitreTicket($faker->sentence($nbWords = 3, $variableNbWords = true));
            $ticket[$i]->setDescriptionTicket($faker->paragraph($nbSentences = 2, $variableNbSentences = true));
            $ticket[$i]->setDateTicket($faker->dateTimeBetween($startDate = '-3 month', $endDate = '+ 1 day'));
            $ticket[$i]->setCategorieTicket($faker->word);
            $ticket[$i]->setUtilisateur($userAdmin);
            $ticket[$i]->setStatut($statutDefault);
            $ticket[$i]->addMateriel($materiel1);
            $ticket[$i]->addSalle($salle1);

            $manager->persist($ticket[$i]);
        }

        for ($i = 0; $i < 10; $i++){
            $ticket[$i] = new Ticket();
            $ticket[$i]->setTitreTicket($faker->sentence($nbWords = 3, $variableNbWords = true));
            $ticket[$i]->setDescriptionTicket($faker->paragraph);
            $ticket[$i]->setDateTicket($faker->dateTimeBetween($startDate = '-3 month', $endDate = '+ 1 day'));
            $ticket[$i]->setCategorieTicket($faker->word);
            $ticket[$i]->setUtilisateur($userAdmin);
            $ticket[$i]->setStatut($statutDefault);
            $ticket[$i]->addMateriel($materiel2);
            $ticket[$i]->addSalle($salle2);

            $manager->persist($ticket[$i]);
        }

        for ($i = 0; $i < 10; $i++){
            $ticket[$i] = new Ticket();
            $ticket[$i]->setTitreTicket($faker->sentence($nbWords = 3, $variableNbWords = true));
            $ticket[$i]->setDescriptionTicket($faker->paragraph);
            $ticket[$i]->setDateTicket($faker->dateTimeBetween($startDate = '-3 month', $endDate = '+ 1 day'));
            $ticket[$i]->setCategorieTicket($faker->word);
            $ticket[$i]->setUtilisateur($userAdmin);
            $ticket[$i]->setStatut($statutDefault);
            $ticket[$i]->addMateriel($materiel3);
            $ticket[$i]->addSalle($salle3);

            $manager->persist($ticket[$i]);
        }

        for ($i = 0; $i < 10; $i++){
            $ticket[$i] = new Ticket();
            $ticket[$i]->setTitreTicket($faker->sentence($nbWords = 3, $variableNbWords = true));
            $ticket[$i]->setDescriptionTicket($faker->paragraph);
            $ticket[$i]->setDateTicket($faker->dateTimeBetween($startDate = '-3 month', $endDate = '+ 1 day'));
            $ticket[$i]->setCategorieTicket($faker->word);
            $ticket[$i]->setUtilisateur($userAdmin);
            $ticket[$i]->setStatut($statutDefault);
            $ticket[$i]->addMateriel($materiel4);
            $ticket[$i]->addSalle($salle4);

            $manager->persist($ticket[$i]);
        }
        $manager->flush();
    }
}
