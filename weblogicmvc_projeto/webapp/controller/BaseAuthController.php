<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;

class BaseAuthController extends BaseController{
    public  function authFilter(){
        if(!AuthManager::isUserLoggedIn()){
            Redirect::toRoute('login/getlogin');
        }
    }

    public function authFilterRole($role){
        if(AuthManager::isUserLoggedIn()){
            if(AuthManager::getLoggedRole()!=$role){
                Redirect::toRoute('login/getlogin');
            }
        }else{
            Redirect::toRoute('login/getlogin');
        }
    }
}
