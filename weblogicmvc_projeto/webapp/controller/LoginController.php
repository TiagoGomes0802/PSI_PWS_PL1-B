<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Debug;

class LoginController extends BaseController{

        public function getLoginForm(){
            return View::make('login.login');
        }

        public function getRegistrationForm(){
            return View::make('login.registarForm');
        }

        public function doRegistration(){                                                                                                        
            $user = new user(Post::getAll());            
            
            $user->role = 'passageiro';

            if($user->is_valid()){
                $user->save();
                Redirect::toRoute('login/getlogin');
            }else{                
                Redirect::flashToRoute('login/getregistration', ['user' => $user]);
            }
        }

        public function doLogin(){            
            $username = Post::get('username');
            $password = Post::get('password');

            $user = User::find_by_username_and_password($username, $password);//encontra os dados do utilizador

            if(!is_null($user)){
                $authmgr = new AuthManager();

                $authmgr->setAuthData($user->id, $user->role);

                $role = $user->role;                

                switch ($role){
                    case 'administrador':
                        Redirect::toRoute('adminapp/index');                                     
                        break;
                    case 'gestor':
                        Redirect::toRoute('gestorapp/index');
                        break;
                    case 'operador':
                        Redirect::toRoute('operadorapp/index');
                        break;
                    case 'passageiro':
                        Redirect::toRoute('passageiroapp/index');
                        break;

                    default:
                        Redirect::toRoute('login/getlogin');
                }

            }else{
                Redirect::toRoute('login/getlogin');
            }
        }

        public function logout(){
            $authmgr = new AuthManager();

            $authmgr->logout();

            Redirect::toRoute('login/getlogin');
        }
}
