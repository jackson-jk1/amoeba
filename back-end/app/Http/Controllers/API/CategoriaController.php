<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Categoria;

class CategoriaController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo incorreto.', $validator->errors());
        }


        $categoria = Categoria::create([
            'nome' => $request->nome,
        ]);

        $categoria->save();

        return $this::enviarRespostaSucesso($categoria, 'Categoria cadastrada com sucesso', 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nome' => 'required|max:255',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $categoria = Categoria::find($request->id);
        if(!$categoria) {
            return $this::enviarRespostaErro('Categoria não encontrada.', null);
        }

        $categoria->nome = $request->nome;

        $categoria->save();

        return $this::enviarRespostaSucesso($categoria, 'Categoria alterada com sucesso', 200);
    }

    

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $categoria = Categoria::find($request->id);
        if(!$categoria) {
            return $this::enviarRespostaErro('Categoria não encontrada.', null);
        }

        if ($categoria->portfolio()->first()){
            return $this::enviarRespostaErro('Categoria está sendo usada.');
        }

        $categoria->delete();

        return $this::enviarRespostaSucesso($categoria, 'Categoria deletada com sucesso', 200);
    }

    public function index()
    {
        $categoria = Categoria::all();
        

            return $this::enviarRespostaSucesso($categoria, 'Categorias cadastradas', 200);
        
    }




    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaSucesso('Erro de validação.', $validator->errors());
        }

        $categoria = Categoria::find($request->id);
        if(!$categoria) {
            return $this::enviarRespostaErro('Categoria não encontrada.', null);
        }

        return $this::enviarRespostaSucesso($categoria);
    }
}
