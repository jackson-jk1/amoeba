<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Contato;

class ContatoController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'endereco' => 'required|max:500',
            'email' => 'required|max:500',
            'telefone' => 'required|max:255',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo incorreto.', $validator->errors());
        }

        $contato = new Contato;
        $contato->endereco = $request->endereco;
        $contato->email = $request->email;
        $contato->telefone = $request->telefone;

        $contato->save();

        return $this::enviarRespostaSucesso($contato, 'Contato cadastrado com sucesso', 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'endereco' => 'required|max:500',
            'email' => 'required|max:500',
            'telefone' => 'required|max:255',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $contato = Contato::find($request->id);
        if(!$contato) {
            return $this::enviarRespostaErro('Contato não encontrado.', null);
        }


        $contato->endereco = $request->endereco;
        $contato->email = $request->email;
        $contato->telefone = $request->telefone;

        $contato->save();

        return $this::enviarRespostaSucesso($contato, 'Contato alterada com sucesso', 200);
    }

    

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $contato = Contato::find($request->id);
        if(!$contato) {
            return $this::enviarRespostaErro('contato não encontrada.', null);
        }
        

        $contato->delete();

        return $this::enviarRespostaSucesso($contato, 'contato deletada com sucesso', 200);
    }

    public function index()
    {
        $contato = Contato::all();
       
            return $this::enviarRespostaSucesso($contato, 'Contatos cadastrados', 200);
       
    }




    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaSucesso('Erro de validação.', $validator->errors());
        }

        $contato = Contato::find($request->id);
        if(!$contato) {
            return $this::enviarRespostaSucesso('Contato não encontrado.', null);
        }

        return $this::enviarRespostaSucesso($contato);
    }
}
