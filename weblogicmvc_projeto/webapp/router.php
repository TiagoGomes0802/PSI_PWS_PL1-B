<?php

/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */

use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName/methodActionName
 ****************************************************************************/
//******************************* Public zone ******************************

// Home Controller
Router::get('/',                            'HomeController/index');
Router::get('home/',                        'HomeController/index');
Router::get('home/index',                    'HomeController/index');
Router::get('home/start',                    'HomeController/start');


// Login Controller
Router::get('login/getregistration',    'LoginController/getRegistrationForm');
Router::post('login/doregistration',    'LoginController/doRegistration');
Router::get('login/getlogin',           'LoginController/getLoginForm');
Router::post('login/dologin',           'LoginController/doLogin');
Router::get('login/logout',             'LoginController/logout');

//******************************* Private zone ******************************

//AdminAppController
Router::get('adminapp/index',           'AdminAppController/index');

//*************************Operações com aeroportos**************************
Router::resource('aeroporto',           'AeroportoController');

//gestorAppController
Router::get('gestorapp/index',           'GestorAppController/index');
Router::get('gestorapp/create',          'GestorAppController/create');

//**************************Operações com os voos*************************** */
Router::resource('voo',                 'VooController');

//**************************Operações com as escalas************************ */
Router::resource('escala',              'EscalaController');

//**************************Operações com os avioes************************ */
Router::resource('plane',              'PlaneController');

//OperadorAppController
Router::get('operadorapp/index',           'OperadorAppController/index');
Router::get('operadorapp/create',          'OperadorAppController/create');
Router::post('operadorapp/store',          'OperadorAppController/store');
Router::get('operadorapp/show',            'OperadorAppController/show');

//Passageiro
Router::get('passageiroapp/index',                'PassageiroAppController/index');
Router::get('passageiroapp/comprarvoo',           'PassageiroAppController/comprarvoo');
Router::get('passageiroapp/show/{param1}',        'PassageiroAppController/show');
Router::get('passageiroapp/vervoo',               'PassageiroAppController/vervoo');
Router::post('passageiroapp/update',              'PassageiroAppController/update');
Router::get('passageiroapp/historico',            'PassageiroAppController/historico');

//simular/comprar a passagem aerea
Router::resource('passagemvendas',      'PassagemVendasController');

//**************************Operações com Users************************ */
Router::resource('user',                 'UserController');

/************** End of URLEncoder Routing Rules ************************************/
