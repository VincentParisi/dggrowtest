<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
  private $validusername = "vincent";
  private $validpwd      = "vincent123";

  public function login () 
  {
     $username = "";
     $error = null;
     $content = $this->render ('security/login.html.twig' , ['username' => $username,
         'error'         => $error]) ;
         return new Response($content);
  }

  public function login_check  (Request $request ) 
  {
    $username = $request->request->get("_username");
    $pwd      = $request->request->get("_password");
    if ($pwd == $this->validpwd  && $username == $this->validusername  ) {
//    if (1 == 1  ) {
      $session = $request->getSession();

      $session->set ("username" , $this->validusername );
      $session->set ("fullname" , "Vincent Parisi" );
      $session->set ("email" , "Vincent.Parisi@my.com" );

         $content = $this->render ('welcome.html.twig' ,  ['session' => $session]) ;
          return new Response($content);
    } else {
        $error = "error";
        $content = $this->render ('security/login.html.twig' ,  
          ['username' => $username,
            'error'         => $error]) ;
        return new Response($content);
    }
  }

  public function displayTable ( Request $request ) 
  {
    $session = $request->getSession();
    $username = $session->get("username" , null);
    if ( $username == null ) {
      return $this->login();
    } else {
         $content = $this->render ('sales.html.twig' , ["path" => __DIR__]) ;
         return new Response($content);
    }
  }

    public function ProductAdd (Request $request ) 
    {
      $session = $request->getSession();
      $username = $session->get("username" , null);
      if ( $username == null ) {
        return $this->login();
      } else {
           $content = $this->render ('product.html.twig' ,  ["path" => __DIR__] ) ;
         return new Response($content);
    }
  }

    public function logout () 
    {
       $content = $this->render ('security/logout.html.twig' , []) ;
           return new Response($content);
    }
    public function logout_check  (Request $request ) 
    {
        $session = $request->getSession();
        $session->set("username" , null);
            $content = $this->render ('security/login.html.twig' , []) ;
        return new Response($content);
   }
    

}

