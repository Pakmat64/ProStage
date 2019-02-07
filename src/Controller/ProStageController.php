<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
	use Doctrine\Common\Persistence\ObjectManager;


class ProStageController extends AbstractController
{

    /**
     * @Route("/", name="pro_stage")
     */
    public function index(StageRepository $repoStage)
    {


        $stages = $repoStage->findByDistinctNom();



          //$repoEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        //$entreprises = $repoEntreprise->findAll();

        return $this->render('pro_stage/index.html.twig',['stages'=>$stages]);
    }

    /**
     * @Route("/parEntreprise/tous", name="pro_stage_tousParEntreprise")
     */
    public function afficherTousParEntreprise(StageRepository $repoStage)
    {
        $stagesParEntreprise = $repoStage->findAllOrderByEntreprise();

        return $this->render('pro_stage/stageTousParEntreprise.html.twig',['stages'=>$stagesParEntreprise,]);
    }

    /**
     * @Route("/parFormation/tous", name="pro_stage_tousParFormation")
     */
    public function afficherTousParFormation(StageRepository $repoStage)
    {
        $stagesParFormation = $repoStage->findAllOrderByFormation();

        return $this->render('pro_stage/stageTousParFormation.html.twig',['stages'=>$stagesParFormation,]);
    }

    /**
     * @Route("/parEntreprise/{id}", name="pro_stage_parEntreprise")
     */
    public function afficherStageParEntreprise($id , StageRepository $repoStageEntreprise)
    {
        $stagesEntreprise = $repoStageEntreprise->findByNomEntreprise($id);

        return $this->render('pro_stage/index.html.twig',['stages'=>$stagesEntreprise]);
    }
    /**
     * @Route("/entreprise/", name="pro_stage_entreprise")
     */
    public function afficherPageEntreprise(EntrepriseRepository $repoEntreprise)
    {
      $entreprises= $repoEntreprise->findAll();

      return $this->render('pro_stage/entreprises.html.twig',['entreprises'=>$entreprises]);
    }

    /**
     * @Route("/formations/", name="pro_stage_formation")
     */
    public function afficherPageFormation()
    {
      return $this->render('pro_stage/formations.html.twig');
    }

    /**
     * @Route("/stages/{id}", name="pro_stage_stages")
     */
    public function afficherPageStage(Stage $stage)
    {
      return $this->render('pro_stage/stages.html.twig',['stage'=>$stage]);
    }


    /**
     * @Route("/entreprise/ajouter", name="pro_stage_entreprise_ajouter")
     */
    public function ajouterEntreprise(Request $requete, ObjectManager $manager)
    {
      $entreprise = new Entreprise();

      //Construction du formulaire
      $formulaireEntreprise = $this->createFormBuilder($entreprise)
      ->add('intitule')
      ->add('adresse',TextareaType::class)
      ->add('activite')
      ->add('URL',UrlType::class)
      ->getForm();

       $formulaireEntreprise->handleRequest($requete);

       if ($formulaireEntreprise->isSubmitted() )
	         {
	            // Enregistrer la ressource en base de données
	            $manager->persist($entreprise);
	            $manager->flush();

	            // Rediriger l'utilisateur vers la page d'accueil
	            return $this->redirectToRoute('pro_stage');
	         }

      return $this->render('pro_stage/ajouterModifierEntreprise.html.twig',['vueFormulaire'=>$formulaireEntreprise->createView(),'action'=>"ajouter"]);
    }

    /**
     * @Route("/entreprise/modifier/{id}", name="pro_stage_entreprise_modifier")
     */
    public function ModifierEntreprise(Request $requete, ObjectManager $manager,Entreprise $entreprise)
    {

      //Construction du formulaire
      $formulaireEntreprise = $this->createFormBuilder($entreprise)
      ->add('intitule')
      ->add('adresse',TextareaType::class)
      ->add('activite')
      ->add('URL',UrlType::class)
      ->getForm();

       $formulaireEntreprise->handleRequest($requete);

       if ($formulaireEntreprise->isSubmitted() )
	         {
	            // Enregistrer la ressource en base de données
	            $manager->persist($entreprise);
	            $manager->flush();

	            // Rediriger l'utilisateur vers la page d'accueil
	            return $this->redirectToRoute('pro_stage');
	         }

      return $this->render('pro_stage/ajouterModifierEntreprise.html.twig',['vueFormulaire'=>$formulaireEntreprise->createView(),'action'=>"modifier"]);
    }

    /**
     * @Route("/stage/ajouter", name="pro_stage_stage_ajouter")
     */
    public function ajouterStage(Request $requete, ObjectManager $manager)
    {
      $stage = new Stage();

      //Construction du formulaire
      $formulaireStage = $this->createFormBuilder($stage)
      ->add('initule')
      ->add('descriptif',TextareaType::class)
      ->add('domaine')
      ->add('email')
      ->add('URL',UrlType::class)
      ->getForm();

       $formulaireStage->handleRequest($requete);

       if ($formulaireStage->isSubmitted() )
	         {
	            // Enregistrer la ressource en base de données
	            $manager->persist($stage);
	            $manager->flush();

	            // Rediriger l'utilisateur vers la page d'accueil
	            return $this->redirectToRoute('pro_stage');
	         }

      return $this->render('pro_stage/ajouterModifierStage.html.twig',['vueFormulaire'=>$formulaireStage->createView(),'action'=>"ajouter"]);
    }

    /**
     * @Route("/stage/modifier/{id}", name="pro_stage_stage_modifer")
     */
    public function modifierStage(Request $requete, ObjectManager $manager,Stage $stage)
    {


      //Construction du formulaire
      $formulaireStage = $this->createFormBuilder($stage)
      ->add('initule')
      ->add('descriptif',TextareaType::class)
      ->add('domaine')
      ->add('email')
      ->add('URL',UrlType::class)
      ->getForm();

       $formulaireStage->handleRequest($requete);

       if ($formulaireStage->isSubmitted() )
	         {
	            // Enregistrer la ressource en base de données
	            $manager->persist($stage);
	            $manager->flush();

	            // Rediriger l'utilisateur vers la page d'accueil
	            return $this->redirectToRoute('pro_stage');
	         }

      return $this->render('pro_stage/ajouterModifierStage.html.twig',['vueFormulaire'=>$formulaireStage->createView(),'action'=>"modifer"]);
    }


}
