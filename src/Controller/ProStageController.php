<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage")
     */
    public function index()
    {
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'ProStageController',
        ]);
    }

    /**
     * @Route("/entreprise/", name="pro_stage_entreprise")
     */
    public function afficherPageEntreprise()
    {
      return $this->render('pro_stage/entreprises.html.twig');
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
      return $this->render('pro_stage/stages.html.twig',['idStage'=>$id]);
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
