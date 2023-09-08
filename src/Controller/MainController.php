<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use App\Repository\SliderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{   
    #[Route('/', name: 'accueil')]
    public function index(SliderRepository $repo, ): Response
    {  
       
        $slider = $repo->findBy([], ['ordre' => 'ASC']);
        return $this->render('main/index.html.twig', ['sliders' => $slider]);
    }
    
    #[Route('/room', name: 'room')]
    public function room(ChambreRepository $chambreRepo): Response
    {
        $chambre = $chambreRepo->findAll();
        return $this->render('main/room.html.twig', [ 'chambres' => $chambre]);
    }


    #[Route('/restaurant', name: 'restaurant')]
    public function food()
    {
        return $this->render('main/restaurant.html.twig');
    }

    
    #[Route('/spa', name: 'spa')]
    public function spa()
    {
        return $this->render('main/spa.html.twig');
    }

    // #[Route('/room/show{id}', name:'detail')]
    // public function roomshow(Chambre $chambre)
    // {
    //     $chambre = $chambreRepo->find()
    //     return $this->render('main/room.html.twig');
    // }
}
