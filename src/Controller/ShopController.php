<?php

namespace App\Controller;

use App\Service\NutApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    private $nutApiService;

    public function __construct(NutApiService $nutApiService)
    {
        $this->nutApiService = $nutApiService;
    }

    /**
     * @Route("/shop", name="shop")
     */
    public function index(NutApiService $nutApiService): Response
    {
        $products = $nutApiService->fetch();
        return $this->render('shop/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/shop/buy", name="shop_buy", methods={"GET","POST"})
     */
    public function buy(Request $request): Response
    {
        $productId = $request->get('product');
        $quantity = $request->get('quantity');
        $order = $this->nutApiService->send($productId,$quantity );


        return $this->render('shop/bill.html.twig', ['order'=>$order]);
    }

}
