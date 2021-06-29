<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class PassageiroAppController extends BaseAuthController{
    
    public function index(){
        $this->authFilterRole('passageiro');

        return View::make('passageiroapp.index');
    }

    public function comprarvoo()
    {
        $this->authFilterRole('passageiro');

        $voos = Voo::all();
        return View::make('passageiroapp.comprarvoo', ['voos' => $voos]);
    }

    public function vervoo($id)
    {
        $this->authFilterRole('passageiro');

        $voo = Voo::find([$id]);       
        $escalas = Escala::find_all_by_idVoo($id);
        
        return View::make('passageiroapp.vervoo', ['voo' => $voo, 'escalas' => $escalas]);
    }

    /**
	 * return a detailed view with record where PK = $id
	 */
	public function show($pais)//id da passagemvenda
	{
        $aeroportos = Aeroporto::find_all_by_pais($pais);
        Debug::barDump($aeroportos);
        die;

		if (is_null($aeroportos)) {
		   //TODO redirect to standard error page
		} else {
		    return View::make('passageiroapp.show', ['aeroportos' => $aeroportos]);
		}
	}

    public function edit($id)
    {
        $voo = Voo::find([$id]);

        $aeroportos = Aeroporto::all();  
        //Debug::barDump($aeroportos);

        if (is_null($voo)) {
            //TODO redirect to standard error page
        } else {
            return View::make('voo.edit', ['voo' => $voo], ['aeroportos' => $aeroportos]);
        }
    }

    public function historico(){
        $this->authFilterRole('passageiro');

        return View::make('passageiroapp.historico');
    }
}
?>