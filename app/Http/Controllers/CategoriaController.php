<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Categoria;
use App\Http\Requests\CategoriasRequest;

class CategoriaController extends Controller
{
    public function listar(){
        $categorias = Categoria::all();

    	return view('categoria.listagem')->with(['categorias' => $categorias]);
    }

    public function novo(){
    	return view('categoria.formulario');
    }

    public function adiciona(CategoriasRequest $request){

		Categoria::create($request->all());
		
		return redirect()->action('CategoriaController@listar')->withInput(Request::only('nome'));
	}

    public function remove($id_categoria){

        $categoria = Categoria::find($id_categoria);
        $categoria->delete();

        return redirect()
               ->action('CategoriaController@listar');
    }

    public function mostra($id){

        $categoria = Categoria::find($id);

        if(empty($categoria)) {
            return "Essa categoria não existe";
        }
        return view('categoria.edita')->with('c', $categoria);
    }

    public function edita($id_categoria){

        $categoria = Categoria::find($id_categoria);
        $params = Request::all();
        $categoria->update($params);

        return redirect()
               ->action('CategoriaController@listar');
    }
}
