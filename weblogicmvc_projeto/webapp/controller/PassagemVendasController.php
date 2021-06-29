<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;


class PassagemVendasController extends BaseAuthController{

    public function index(){
        $this->authFilterRole('passageiro');
        
        return View::make('passagemvendas.index');
    }


    public function create($id)
    {
        $voo = Voo::find([$id]);  
        $escalas = Escala::find_all_by_idVoo($id); 

		$vooV = Voo::find_by_idAeroportoorigem($voo->idaeroportodestino);
		Debug::barDump($vooV);

        return View::make('passagemvenda.create', ['voo' => $voo, 'escalas' => $escalas]);
    }

	public function createid($id)
    {

        $voo = Voo::find([$id]);  
        $escalas = Escala::find_all_by_idVoo($id); 

		$vooVolta = Voo::find([$id+1]);
		$escalasVolta = Escala::find_all_by_idVoo($id+1);

        return View::make('passagemvenda.createid', ['voo' => $voo, 'escalas' => $escalas, 'voovolta' => $vooVolta, 'escalasvolta' =>$escalasVolta]);
    }

    /**
	 * return a detailed view with record where PK = $id
	 */
	public function show($id)//id da passagemvenda
	{
        $passagem = PassagemVenda::find([$id]);

		if (is_null($passagem)) {
		   //TODO redirect to standard error page
		} else {
		    return View::make('passagemvenda.show', ['passagem' => $passagem]);
		}
	}

    public function store()
    {
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields

        Debug::barDump(Post::getAll());		

        $compra = new PassagemVenda(Post::getAll());

        Debug::barDump($compra);

        if($compra->is_valid()){
            $compra->save();
            Redirect::toRoute('passageiroapp/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('passagemvenda/create', ['compra' => $compra]);
        }
    }

    public function edit($id)
	{
        $this->authFilterRole('operador');

		$plane = Plane::find([$id]);

		if (is_null($plane)) {
		   //TODO redirect to standard error page
		} else {
		    return View::make('plane.edit', ['plane' => $plane]);
		}
	}

    /**
	 * Receives record data through POST method and updates it in the DB table
	 */
	public function update($id)
	{
		//find resource (activerecord/model) instance where PK = $id
		//your form name fields must match the ones of the table fields
		$passagem = PassagemVenda::find([$id]);
        $passagem->checkin = 'concluido';
		$passagem->update_attributes(Post::getAll());

		if($passagem->is_valid()){
		    $passagem->save();
		    Redirect::toRoute('operadorapp/index');
		} else {
		    //redirect to form with data and errors
		    Redirect::flashToRoute('operadorapp/index', ['plane' => $plane]);
		}
	}

}