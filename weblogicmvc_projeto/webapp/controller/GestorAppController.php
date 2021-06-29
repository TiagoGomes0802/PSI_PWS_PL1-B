<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class GestorAppController extends BaseAuthController{
    
    public function index(){
        $this->authFilterRole('gestor');

        return View::make('gestorapp.index');
    }

    public function create(){
        $this->authFilterRole('administrador');
        
        return View::make('gestorapp.create');
    }
}
?>