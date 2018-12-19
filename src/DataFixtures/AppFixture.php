<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class AppFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
    //  $faker = Faker\Factory::create('fr_FR');

      //-------  Les entreprises  ---------

      $entrepriseSafran= new Entreprise();
      $entrepriseSafran->setIntitule("Safran");
      $entrepriseSafran->setAdresse("5 avenue du 14 juillet");
      $entrepriseSafran->setActivite("Aéronotique");
      //$entrepriseSafran->addStage($stageSafran1);
      //$entrepriseSafran->addStage($stageSafran2);
      $manager->persist($entrepriseSafran);

      $entrepriseTotal= new Entreprise();
      $entrepriseTotal->setIntitule("Total");
      $entrepriseTotal->setAdresse("6 rue du 1 mai");
      $entrepriseTotal->setActivite("Pétrole");
      $manager->persist($entrepriseTotal);

      $entrepriseDassaut = new Entreprise();
      $entrepriseDassaut->setIntitule("Dassaut");
      $entrepriseDassaut->setAdresse("67 avenue de la sirenne");
      $entrepriseDassaut->setActivite("Aéronotique");
      $manager->persist($entrepriseDassaut);


      //-------------Formation --------------
      $formationIUT = new Formation();
      $formationIUT->setIntitule("DUT Informatique");
      $formationIUT->setAdresse("2 Allée du Parc Montaury, 64600 Anglet");
      $formationIUT->setTelephone("0559269802");
      $formationIUT->setMail("forco@iutbayonne.univ-pau.fr");
      //$formationIUT->addStage($stageSafran1);
      //$formationIUT->addStage($stageSafran2);
      $manager->persist($formationIUT);


      //-------------Les stages -----------

      $stageSafran1 = new Stage();
      $stageSafran1->setInitule("Refonte et mise a jout de l'intranet du service production");
      $stageSafran1->setDescriptif("description");
      $stageSafran1->setDomaine("Web");
      $stageSafran1->setEmail("safran@gmail.com");
      $stageSafran1->setEntreprise($entrepriseSafran);
      $stageSafran1->addFormation($formationIUT);

      $manager->persist($stageSafran1);

      $stageSafran2 = new Stage();
      $stageSafran2->setInitule("Développement d'un viewer cartographique");
      $stageSafran2->setDescriptif("Descriptif");
      $stageSafran2->setDomaine("Programmtion");
      $stageSafran2->setEmail("safran@gmail.com");
      $stageSafran2->setEntreprise($entrepriseSafran);
      $stageSafran2->addFormation($formationIUT);

      $manager->persist($stageSafran2);

      $stageSafran3 = new Stage();
      $stageSafran3->setInitule("Conception d'un module d'export / import de données SAP");
      $stageSafran3->setDescriptif("Descriptif");
      $stageSafran3->setDomaine("Conception - Base de données");
      $stageSafran3->setEmail("safran@gmail.com");
      $stageSafran3->setEntreprise($entrepriseSafran);
      $stageSafran3->addFormation($formationIUT);

      $manager->persist($stageSafran3);




        $manager->flush();
    }
}
