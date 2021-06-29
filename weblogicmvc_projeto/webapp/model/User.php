<?php

use ActiveRecord\Model;

class user extends Model {
    static $validates_presence_of = array(
        array('primeironome'),
        array('apelido'),
        array('telemovel'),
        array('email'),
        array('morada'),        
        array('username'),
        array('password'),
        array('role')
    );

    static $validate_size_of = array(
        array('primeiroNome', 'maximum' => 80),
        array('apelido', 'maximum' => 80),
        array('morada', 'maximum' => 120),
        array('email', 'maximum' => 60),
        array('telemovel', 'is' => 9),
        array('username', 'maximum' => 30),
        array('password', 'maximum' => 30),
        array('role', 'maximum' => 17)
        );

    static $validates_inclusion_of = array(
        array('role', 'in' => array('passageiro', 'operador', 'gestor', 'administrador'))
    );

    static $validates_numericality_of = array(
        array('telemovel', 'only_integer' => true)
    );
}
