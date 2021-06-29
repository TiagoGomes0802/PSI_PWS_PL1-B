<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;


class OperadorAppController extends BaseAuthController{
    
    public function index(){
        $this->authFilterRole('operador');
        
        $passagens = PassagemVenda::all(); 

        return View::make('operadorapp.index', ['passagens' => $passagens]);
    }

    public function create(){
        $this->authFilterRole('administrador');
        
        return View::make('operadorapp.create');
    }

    public function show(){
        $this->authFilterRole('administrador');
        
        return View::make('operadorapp.show');
    }
}
?>