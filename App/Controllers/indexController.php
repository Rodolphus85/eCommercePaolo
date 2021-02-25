<?php
namespace App\Controllers;

//$_SESSION = array();
//session_unset();
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

session_start();

class indexController extends baseController
{
    private $entityManager;
    protected $templateEngine;

    public function __construct(EntityManager $entityManager){
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    public function action(){
        $src_images = "/images/";
        $src_images_products = "/images/Products/";

        $repo = $this->entityManager->getRepository('App\Entities\AppProduct');

        $productos = $repo->findAll();

        $response = new Response($this->templateEngine->render('index.html.twig', [
                'productos' => $productos,
                'src_images' => $src_images,
                'src_images_products' => $src_images_products
        ]));

        return $response;
    }
}