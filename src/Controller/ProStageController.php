<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;


class ProStageController extends AbstractController
{

    /**
     * @Route("/", name="pro_stage")
     */
    public function index()
    {
        $repoStage = $this->getDoctrine()->getRepository(Stage::class);

        $stages = $repoStage->findByDistinctNom();



        $repoEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        $entreprises = $repoEntreprise->findAll();

        return $this->render('pro_stage/index.html.twig',['stages'=>$stages,'entreprises'=>$entreprises]);
    }

    /**
     * @Route("/parEntreprise/tous", name="pro_stage_tousParEntreprise")
     */
    public function afficherTousParEntreprise()
    {
        $repoStage = $this->getDoctrine()->getRepository(Stage::class);

        $stagesParEntreprise = $repoStage->findAllOrderByEntreprise();

        return $this->render('pro_stage/index.html.twig',['stages'=>$stagesParEntreprise,]);
    }





    /**
     * @Route("/parEntreprise/{id}", name="pro_stage_parEntreprise")
     */
    public function afficherStageParEntreprise($id)
    {
        $repoStageEntreprise = $this->getDoctrine()->getRepository(Stage::class);
        $stagesEntreprise = $repoStageEntreprise->findByNomEntreprise($id);
        return $this->render('pro_stage/index.html.twig',['stages'=>$stagesEntreprise]);
    }
    /**
     * @Route("/entreprise/", name="pro_stage_entreprise")
     */
    public function afficherPageEntreprise()
    {
      $repoEntreprise= $this->getDoctrine()->getRepository(Entreprise::class);
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
    public function afficherPageStage($id)
    {
      $repoStage = $this->getDoctrine()->getRepository(Stage::class);
      $stage = $repoStage->find($id);

      return $this->render('pro_stage/stages.html.twig',['stage'=>$stage]);
    }





}
