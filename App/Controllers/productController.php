<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class productController extends baseController
{
    private $entityManager;
    protected $templateEngine;

    public function __construct(EntityManager $entityManager){
        parent::__Construct();
        $this->entityManager = $entityManager;
    }

    public function action($id, Request $request){

        $src_images_products = "/images/Products/";

        //$id = $request->get('id');
        $repo = $this->entityManager->getRepository('App\Entities\AppProduct');

        $producto = $repo->find($id);

        $response = new Response($this->templateEngine->render('product.html.twig', [
            'src_images_products' => $src_images_products,
            'producto' => $producto
        ]));

        return $response;
    }
}