<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;


class AdminAppController extends BaseAuthController{
    
    public function index(){
        $this->authFilterRole('administrador');
        
        return View::make('adminapp.index');
    }
}
?>