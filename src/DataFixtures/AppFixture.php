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
      $entrepriseSafran->setURL("http://scd.rfi.fr/sites/filesrfi/imagecache/rfi_16x9_1024_578/sites/images.rfi.fr/files/aef_image/2016-02-26T103056Z_2061078702_D1BESPFSDSAA_RTRMADP_3_FRANCE-TOTAL-IRAQ_0.JPG");
      //$entrepriseSafran->addStage($stageSafran1);
      //$entrepriseSafran->addStage($stageSafran2);
      $manager->persist($entrepriseSafran);

      $entrepriseTotal= new Entreprise();
      $entrepriseTotal->setIntitule("Total");
      $entrepriseTotal->setAdresse("6 rue du 1 mai");
      $entrepriseTotal->setActivite("Pétrole");
      $entrepriseTotal->setURL("https://media.glassdoor.com/l/ba/3f/2d/a7/safram.jpg");
      $manager->persist($entrepriseTotal);

      $entrepriseDassaut = new Entreprise();
      $entrepriseDassaut->setIntitule("Dassaut");
      $entrepriseDassaut->setAdresse("67 avenue de la sirenne");
      $entrepriseDassaut->setActivite("Aéronotique");
      $entrepriseDassaut->setURL("https://www.dassault-aviation.com/wp-content/blogs.dir/1/files/2018/05/DA00031027_Si-1.jpg");
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
      $stageSafran1->setInitule("Refonte e mise a jout de l'intranet de production");
      $stageSafran1->setDescriptif("Dans ce stage, il s'agit de rédéfinir l'intranet de la branche de production de safran, ce qui touchera la conception et le codage");
      $stageSafran1->setDomaine("Web");
      $stageSafran1->setEmail("safran@gmail.com");
      $stageSafran1->setURL("https://static.latribune.fr/full_width/380014/safran-annonce-une-commande-de-2-milliards-de-dollars-pour-cfm.jpg");
      $stageSafran1->setEntreprise($entrepriseSafran);
      $stageSafran1->addFormation($formationIUT);

      $manager->persist($stageSafran1);

      $stageSafran2 = new Stage();
      $stageSafran2->setInitule("Développement d'un viewer cartographique");
      $stageSafran2->setDescriptif("Il s'agit maintenant de coder une application permettant de visualiser la cartographie des processus métier d'une entreprise");
      $stageSafran2->setDomaine("Programmtion");
      $stageSafran2->setEmail("safran@gmail.com");
      $stageSafran2->setURL("https://media.glassdoor.com/l/ba/3f/2d/a7/safram.jpg");
      $stageSafran2->setEntreprise($entrepriseSafran);
      $stageSafran2->addFormation($formationIUT);

      $manager->persist($stageSafran2);

      $stageSafran3 = new Stage();
      $stageSafran3->setInitule("Conception d'un module d'export & import de données SAP");
      $stageSafran3->setDescriptif("Ce stage ne concerne que la partie conception touchant les données d'import et export de données");
      $stageSafran3->setDomaine("Conception - Base de données");
      $stageSafran3->setEmail("safran@gmail.com");
      $stageSafran3->setURL("http://www.air-cosmos.com/upload/18/pics/2016/05/web/572c5ac952682.jpg");
      $stageSafran3->setEntreprise($entrepriseSafran);
      $stageSafran3->addFormation($formationIUT);

      $manager->persist($stageSafran3);

      $stageDassault1 = new Stage();
      $stageDassault1->setInitule("Réalisation d’une plateforme de simulation d’images ultrasonores");
        $stageDassault1->setDescriptif("BlaBlaBlaBla");
      $stageDassault1->setDomaine("Développement web");
        $stageDassault1->setEmail("dassault@gmail.com");
        $stageDassault1->setURL("http://www.air-cosmos.com/upload/18/pics/2016/05/web/572c5ac952682.jpg");
        $stageDassault1->setEntreprise($entrepriseDassaut);
      $stageDassault1->addFormation($formationIUT);

      $manager->persist($stageDassault1);



        $manager->flush();
    }
}
