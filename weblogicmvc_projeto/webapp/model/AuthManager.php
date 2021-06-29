<?php

use ArmoredCore\WebObjects\Session;

class authManager{
    public function setAuthData($userID, $userRole){
        Session::set('APP_USER_ID', $userID);
        Session::set('APP_USER_ROLE', $userRole);
    }

    public function logout(){
        Session::destroy();
    }

    static public function isUserLoggedIn(){
        return Session::has('APP_USER_ID');
    }

    static public function getLoggedRole(){
        if(self::isUserLoggedIn()){
            return Session::get('APP_USER_ROLE');
        }
    }

    static public function getLoggedID(){
        if(self::isUserLoggedIn()){
            return Session::get('APP_USER_ID');
        }
    }
}
