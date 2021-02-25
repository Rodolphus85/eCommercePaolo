<?php
namespace App\Controllers;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class cartListController extends baseController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager){
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    public function action(){
        $src_images_products = "/images/Products/";

        $productos = null;

        if(isset($_SESSION['cart'])){
            $cant_productos = count($_SESSION['cart']);
            $cart_products='';

            for($i=0; $i < $cant_productos; $i++){
                $cart_products .=  $_SESSION['cart'][$i] . ',';
            }

            $cart_products = trim($cart_products, ',');

            $repo = $this->entityManager->getRepository('App\Entities\AppProduct');

            $productos = $repo->createQueryBuilder('product')
                ->select('product.name, product.price, product.imagen')
                ->where('product.id in ('.$cart_products.')')
                ->getQuery()
                ->getResult();
        }

        $response = new Response($this->templateEngine->render('cart_list.html.twig', [
            'src_images_products' => $src_images_products,
            'productos' => $productos
        ]));

        return $response;
    }
}