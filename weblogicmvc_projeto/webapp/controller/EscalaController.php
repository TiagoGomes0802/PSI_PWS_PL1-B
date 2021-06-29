<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Debug;

class EscalaController extends BaseAuthController implements ResourceControllerInterface
{
    /**
     * Returns index view with all records
     */
    public function index()//$idVoo)
    {
        //$this->authFilterRole('gestorvoo');

        $escalas = Escala::all();

        return View::make('escala.index', ['escalas' => $escalas]);
    }


    /**
     * Returns a view with a form to create a new record
     */
    public function create()
    {
        $aeroportos = Aeroporto::all();
        return View::make('escala.create', ['aeroportos' => $aeroportos]);        
    }


    /**
     * Receives new record data through POST method and stores it in the DB table
     */
    public function store()
    {
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        Debug::barDump(Post::getAll());

        $escala = new Escala(Post::getAll());

        if($escala->is_valid()){
            $escala->save();
            Redirect::toRoute('escala/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('escala/create', ['escala' => $escala]);
        }
    }


    /**
     * return a detailed view with record where PK = $id
     */
    public function show($id)
    {
        $escala = Escala::find([$id]);

        if (is_null($escala)) {
            //TODO redirect to standard error page
        } else {
            return View::make('escala.show', ['escala' => $escala]);
        }
    }


    /**
     * return a editable form view with record where PK = $id
     */
    public function edit($id)
    {
        $escala = Escala::find([$id]);
        $aeroportos = Aeroporto::all();

        if (is_null($escala)) {
            //TODO redirect to standard error page
        } else {
            return View::make('escala.edit', ['escala' => $escala, 'aeroportos' => $aeroportos]);
        }
    }


    /**
     * Receives record data through POST method and updates it in the DB table
     */
    public function update($id)
    {
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $escala = Escala::find([$id]);
        $escala->update_attributes(Post::getAll());

        if($escala->is_valid()){
            $escala->save();
            Redirect::toRoute('escala/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('escala/edit', ['escala' => $escala]);
        }
    }


    /**
     * deletes the record where PK = $id
     */
    public function destroy($id)
    {
        $escala = Escala::find([$id]);
        $escala->delete();
        Redirect::toRoute('escala/index');
    }
}