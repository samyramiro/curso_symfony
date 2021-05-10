<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Usuario;

/**
 * @Route("/users")
 */

class UserController extends AbstractController{

    /**
     * @Route("/alta",name="alta_user")
     */
    public function altaUser(Request $request){

        
        //$nombre = $request->query->get("nombre");
        //$nombre = $request->request->get("nombre");
        
        
        //$email = $paramFetcher->get('email');
        
        $em = $this->getDoctrine()->getManager();
        try{
            $usuario =  new Usuario("Belén","Quiñones","bquiñones@gmail.com","123456");
        
            $em->persist($usuario);
            
            $em->flush();       
            

        }catch(\Exception $e){
           
        }

       
        $usuarios = $em->getRepository(Usuario::class)->findAll();
        
        
        $roles = ["ADMINISTRADOR", "OPERADOR", "CARGA_USUARIOS"];
        
        
        return $this->render('user/alta_user.hml.twig',["roles" => $roles, "valor" => 1 ]);



       
    }
    /**
     * @Route("/list",name="list_user")
     */
    public function listUser(Request $request){

        $em = $this->getDoctrine()->getManager();

        $listaUsuarios = $em->getRepository(Usuario::class)->findAll(); //Me traigo todos los usuarios
        
        //LISTAR TODOS USUARIO


        $usuario = $em->getRepository(Usuario::class)->findByNombre('Samanta'); //Me traigo al usuario con nombre Carlin
        
        

        return $this->render('user/list_user.html.twig',["users" => $listaUsuarios, "usuariologueado" => $usuario[0]]);


        
    }
    /**
     * @Route("/update",name="update_user")
     */
    public function updateUser(Request $request){
        
        $em = $this->getDoctrine()->getManager();
        $email = "matias@hotmail.com";
        $usuario = $em->getRepository(Usuario::class)->findOneBy(["id" => 1]);
        $usuario->setNombre("NOMBRE NUEVO");
        $usuario->setEmail($email);
        $em->flush();
        
        return "Update User";

    }

    /**
     * @Route("/validar",name="validar_user")
     */
    public function ValidarUser(Request $request){
        
        $em = $this->getDoctrine()->getManager();
        
        $usuario = $em->getRepository(Usuario::class)->findOneBy(["id" => 1]);
        $usuario->setNombre("NOMBRE NUEVO");
        $usuario->setEmail($email);
        $em->flush();
        
        return "Update User";

    }




    


    

}