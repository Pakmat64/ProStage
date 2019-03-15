<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
	use Doctrine\Common\Persistence\ObjectManager;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\EntrepriseType;
use App\Form\FormationType;

class ProStageController extends AbstractController
{

    /**
     * @Route("/", name="pro_stage")
     */
    public function index(StageRepository $repoStage)
    {
        $stages = $repoStage->findByDistinctNom();

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
     * @Route("/parEntreprise/{nom}", name="pro_stage_parEntreprise")
     */
    public function afficherStageParEntreprise($nom , StageRepository $repoStageEntreprise)
    {
        $stagesEntreprise = $repoStageEntreprise->findByNomEntreprise($nom);

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
     * @Route("/stages/", name="pro_stage_stages_tous")
     */
    public function afficherTousStages(StageRepository $repoStage)
    {
      $stages= $repoStage->findAll();

      return $this->render('pro_stage/stagesTous.html.twig',['stages'=>$stages]);
    }

    /**
     * @Route("/formations/", name="pro_stage_formation")
     */
    public function afficherPageFormation(FormationRepository $repoFormation)
    {
			$formations = $repoFormation->findAll();

			return $this->render('pro_stage/formations.html.twig',['formations'=>$formations]);
    }

    /**
     * @Route("/stages/{id}", name="pro_stage_stages")
     */
    public function afficherPageStage(Stage $stage)
    {
      return $this->render('pro_stage/stages.html.twig',['stage'=>$stage]);
    }

    /**
     * @Route("/admin/entreprise/ajouter", name="pro_stage_entreprise_ajouter")
     */
    public function ajouterEntreprise(Request $requete, ObjectManager $manager)
    {
      $entreprise = new Entreprise();

      //Construction du formulaire
      $formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);


       $formulaireEntreprise->handleRequest($requete);

       if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
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
      $formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);

       $formulaireEntreprise->handleRequest($requete);

       if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
	         {
	            // Enregistrer la ressource en base de données
	            $manager->persist($entreprise);
	            $manager->flush();

	            // Rediriger l'utilisateur vers la page d'accueil
	            return $this->redirectToRoute('pro_stage_entreprise');
	         }

      return $this->render('pro_stage/ajouterModifierEntreprise.html.twig',['vueFormulaire'=>$formulaireEntreprise->createView(),'action'=>"modifier"]);
    }

    /**
     * @Route("/user/stage/ajouter", name="pro_stage_stage_ajouter")
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
			->add('entreprise', EntityType::class, array(
	                'class' => Entreprise::class,
	                'choice_label' => 'intitule',
	                'multiple' => false,
	                'expanded' => false,
	            ))
			->add('formations', EntityType::class, array(
					        'class' => Formation::class,
					        'choice_label' => 'intitule',
					        'multiple' => true,
					        'expanded' => true,
					    ))

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
			->add('entreprise', EntityType::class, array(
	                'class' => Entreprise::class,
	                'choice_label' => 'intitule',
	                'multiple' => false,
	                'expanded' => false,))
			->add('formations', EntityType::class, array(
									'class' => Formation::class,

									'choice_label' => 'intitule',
									'multiple' => true,
									'expanded' => true,))
      ->getForm();

       $formulaireStage->handleRequest($requete);

       if ($formulaireStage->isSubmitted() )
	         {
	            // Enregistrer le stage en base de données
	            $manager->persist($stage);
	            $manager->flush();

	            // Rediriger l'utilisateur vers la page d'accueil
	            return $this->redirectToRoute('pro_stage');
	         }

      return $this->render('pro_stage/ajouterModifierStage.html.twig',['vueFormulaire'=>$formulaireStage->createView(),'action'=>"modifer"]);
    }

		/**
     * @Route("/formation/ajouter", name="pro_stage_formation_ajouter")
     */
    public function ajouterFormation(Request $requete, ObjectManager $manager)
    {
      $formation = new Formation();

      //Construction du formulaire
      $formulaireFormation = $this->createForm(FormationType::class, $formation);

       $formulaireFormation->handleRequest($requete);

       if ($formulaireFormation->isSubmitted() )
	         {
	            // Enregistrer la ressource en base de données
	            $manager->persist($formation);
	            $manager->flush();

	            // Rediriger l'utilisateur vers la page d'accueil
	            return $this->redirectToRoute('pro_stage');
	         }

      return $this->render('pro_stage/ajouterModifierFormation.html.twig',['vueFormulaire'=>$formulaireFormation->createView(),'action'=>"ajouter"]);
    }

		/**
     * @Route("/formation/modifier/{id}", name="pro_stage_formation_modifier")
     */
    public function modifierFormation(Request $requete, ObjectManager $manager,Formation $formation)
    {
      //Construction du formulaire
      $formulaireFormation = $this->createForm(FormationType::class, $formation);

       $formulaireFormation->handleRequest($requete);

       if ($formulaireFormation->isSubmitted() )
	         {
	            // Enregistrer la ressource en base de données
	            $manager->persist($formation);
	            $manager->flush();

	            // Rediriger l'utilisateur vers la page d'accueil
	            return $this->redirectToRoute('pro_stage_formation');
	         }

      return $this->render('pro_stage/ajouterModifierFormation.html.twig',['vueFormulaire'=>$formulaireFormation->createView(),'action'=>"modifier"]);
    }
}
