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

        $stages = $repoStage->findAll();

        $repoEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        $entreprise = $repoEntreprise->findAll();

        return $this->render('pro_stage/index.html.twig',['stages'=>$stages,'entreprises'=>$entreprise]);
    }


    /**
     * @Route("/parEntreprise/{nom}", name="pro_stage_parEntreprise")
     */
    public function afficherStageParEntreprise($nom)
    {
        $repoStageEntreprise = $this->getDoctrine()->getRepository(Stage::class);
        $stagesEntreprise = $repoStageEntreprise->findByNomEntreprise($nom);
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

    ///**
     //* @Route("/stages/entreprise/{id}", name="pro_stage_stagesParEntreprise")
     //*/
    //public function afficherPageStage($id)
    //{
      //$entreprise= $this->getDoctrine()->getRepository(Entreprise::class)->findOneBy(["id" => $id])

      //$stages = $this->getDoctrine()->getRepository(Stage::class)->findBy(["entreprises"=>$id]);
      //$stage = $repoStage->findBy([])

      //return $this->render('pro_stage/stages.html.twig',['idStage'=>$id,"entreprise");
    //}



}
