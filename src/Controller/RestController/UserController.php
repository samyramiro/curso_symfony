<?php

namespace App\Controller\RestController;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Extensions\UserUtilitiesTrait;
use App\Entity\Usuario;


/**
 * @Rest\Route("api/users")
 */

class UserController extends AbstractFOSRestController{

     /**
     * @Rest\Get("/all", name="api_all_users")
     * @return Response
     */
    public function getAllUser(Request $request) {
        
        $em = $this->getDoctrine()->getManager();

        $listaUsuarios = $em->getRepository(Usuario::class)->findAll(); //Me traigo todos los usuarios
        
        //LISTAR TODOS USUARIO


        $usuario = $em->getRepository(Usuario::class)->findByNombre('Samanta'); //Me traigo al usuario con nombre Carlin
        
        

        return $this->render('user/list_user.html.twig',["users" => $listaUsuarios, "usuariologueado" => $usuario[0]]);
       /* $em = $this->getDoctrine()->getManager();

        //$hola = $this->formatUser();
        $listaUsuarios = $em->getRepository(Usuario::class)->findAll();
        
        
        return $this->handleView($this->view($listaUsuarios,200));*/
    }

    /**
     * @Rest\Post("/alta",name="api_alta_user")
     * @return Response
     */
    public function altaUser(Request $request){
        $em = $this->getDoctrine()->getManager();

        return $this->handleView($this->view("hola Mundo"));
    }  

    /**
     * @Rest\Post("/validar",name="api_validar_user")
     * @return Response
     */
    public function ValidarUser(Request $request){
        
        $em = $this->getDoctrine()->getManager();
      
        $email = $request->request->get('email');        
        $password = $request->request->get('password');

        $usuario = $em->getRepository(Usuario::class)->findOneBy(["email" => $email]);
        $clave = $usuario->getPassword();

        if ($password==$clave) {            
            return $this->render('user/list_user.html.twig',["usuariologueado" => $usuario,"estado" => "AUTORIZADO"]);
        }else{           
            return $this->render('user/list_user.html.twig',["estado" => "NO AUTORIZADO"]);
        }
        
      }

}