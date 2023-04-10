<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Repository\LivresRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{
    #[Route('admin/livres', name: 'app_admin_livres')]
    public function index(LivresRepository $rep): JsonResponse
    {
        //version non optimisé ****************************
        // en parametres index (ManagerRegitry $doctrine)
       //$rep=$doctrine->getRepository(Livres::class);
       //$livres=$rep->findAll();
       //dd($livres);

        // version optimisé ********************************
        $livres=$rep->findAll();
        dd($livres);
    }
    #[Route('admin/livres/find/{id}', name: 'app_admin_livres_find_id')]
    public function find(Livres $livre): JsonResponse
    {
//        find (ManagerRegistry $doctrine, $id)
//        $rep=$doctrine->getRepository(Livres::class);
//        $livre=$rep->find($id);
//        dd($livre);
        // version optimisé ********************************
        dd($livre);
    }
    #[Route('admin/livres/add', name: 'app_admin_livres_add')]
    public function add(ManagerRegistry $doctrine): JsonResponse
    {
        $date=new \DateTime('2022-01-01'); // \ pour utiliser le global sortir du namespace

        //avant de persister l'objet --> le créer
        $livre=new Livres();
        //$livre->setLibelle("Réseaux");
        //$livre->setResume("Résumer Réseaux");
        //$livre->setImage("http://via.placeholder.com/300");
        //$livre->setImage("Dunod");
        //$livre->setDateEdition($date)
        //$livre->setPrix(100);
        //ou bien  design pattern fluat chque setter retourne un objet livre kemel
        $livre  ->setLibelle("Réseaux")
                ->setResume("Résumer Réseaux")
                ->setImage("http://via.placeholder.com/300")
                ->setEditeur("Dunod")
                ->setDateEdition($date)
                ->setPrix(100);
        //persister l'objet

            $entityManager=$doctrine->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

        dd($livre);
    }
    #[Route('admin/livres/update/{id}', name: 'app_admin_livres_update_id')]
    public function update(Livres $livre,ManagerRegistry $doctrine, $id): JsonResponse
    {
//        $rep=$doctrine->getRepository(Livres::class);
//        $livre=$rep->find($id);
//        $livre->setPrix(120);
//        $em=$doctrine->getManager();
//        $em->flush();
//        dd($livre);

        // version optimisé ********************************
        $livre->setPrix(120);
        $em=$doctrine->getManager();
        $em->flush();
        dd($livre);
    }
    #[Route('admin/livres/delete/{id}', name: 'app_admin_livres_delete_id')]
    public function delete(Livres $livre,ManagerRegistry $doctrine, $id): JsonResponse
    {
//        $rep=$doctrine->getRepository(Livres::class);
//        $livre=$rep->find($id);
//        $em=$doctrine->getManager();
//        $em->remove($livre);
//        $em->flush();
//        dd('ok');
        // version optimisé ********************************
        $em=$doctrine->getManager();
        $em->remove($livre);
        $em->flush();
        dd('ok');
    }

}
