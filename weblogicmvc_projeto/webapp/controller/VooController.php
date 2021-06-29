<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class VooController extends BaseController implements ResourceControllerInterface
{
    /**
     * Returns index view with all records
     */
    public function index()
    {
        //$this->authFilterRole('gestorvoo');
        $voos = Voo::all();    
        $aeroportos = Aeroporto::all();  
        return View::make('voo.index', ['voos' => $voos], ['aeroportos' => $aeroportos]);
    }


    /**
     * Returns a view with a form to create a new record
     */
    public function create()
    {
        $aeroportos = Aeroporto::all();
        return View::make('voo.create', ['aeroportos' => $aeroportos]);
    }


    /**
     * Receives new record data through POST method and stores it in the DB table
     */
    public function store()
    {
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $voo = new Voo(Post::getAll());

        if($voo->is_valid()){
            $voo->save();
            Redirect::toRoute('voo/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('voo/create', ['voo' => $voo]);
        }
    }


    /**
     * return a detailed view with record where PK = $id
     */
    public function show($id)
    {
        $voo = Voo::find([$id]);

        if (is_null($voo)) {
            //TODO redirect to standard error page
        } else {
            return View::make('voo.show', ['voo' => $voo]);
        }
    }


    /**
     * return a editable form view with record where PK = $id
     */
    public function edit($id)
    {
        $voo = Voo::find([$id]);

        $aeroportos = Aeroporto::all();  
        Debug::barDump($aeroportos);

        if (is_null($voo)) {
            //TODO redirect to standard error page
        } else {
            return View::make('voo.edit', ['voo' => $voo, 'aeroportos' => $aeroportos]);
        }
    }


    /**
     * Receives record data through POST method and updates it in the DB table
     */
    public function update($id)
    {
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $voo = Voo::find([$id]);
        $voo->update_attributes(Post::getAll());

        if($voo->is_valid()){
            $voo->save();
            Redirect::toRoute('voo/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('voo/edit', ['voo' => $voo]);
        }
    }


    /**
     * deletes the record where PK = $id
     */
    public function destroy($id)
    {
        $escalas = Escala::find_all_by_idvoo([$id]);
        foreach ($escalas as $escala)
        {
            $escala->delete();
        }
        $voo = Voo::find([$id]);
        $voo->delete();
        Redirect::toRoute('voo/index');
    }
}