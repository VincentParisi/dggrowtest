<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Doctrine\ORM\EntityManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Config\FileLocator;



class ApiController extends AbstractController
{
  /**
   * @Route("/sales/data", name="api_sales_list" , methods={"GET"} )
   */
  public function getListSales () 
  {
      $file = __DIR__.'/potato_sales.json'; 
      $json   =    file_get_contents ($file)  ;
      return new Response($json , 200 ,["Content-Type" => "application/json"], true );
  }


  /**
   * @Route("/product/add", name="api_product_add" , methods={"POST"} )
   */
  public function ProductAdd () 
  {
      $json   = json_encode ("Data Recived  From Server with Success ");

      return new Response($json , 200 ,["Content-Type" => "application/json"], true );
  }



}


