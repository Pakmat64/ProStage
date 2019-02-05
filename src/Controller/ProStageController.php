<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;

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





}
