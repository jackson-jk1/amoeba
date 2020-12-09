<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Mensagem;

class MensagemController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'email' => 'required|max:255',
            'assunto' => 'required|max:255',
            'mensagem' => 'required|max:500',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo incorreto.', $validator->errors());
        }

        $mensagem = new Mensagem;
        $mensagem->nome = $request->nome;
        $mensagem->email = $request->email;
        $mensagem->assunto = $request->assunto;
        $mensagem->mensagem = $request->mensagem;

        $mensagem->save();

        return $this::enviarRespostaSucesso($mensagem, 'Mensagem cadastrada com sucesso', 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'email' => 'required|max:255',
            'assunto' => 'required|max:255',
            'mensagem' => 'required|max:500',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $mensagem = Mensagem::find($request->id);
        if(!$mensagem) {
            return $this::enviarRespostaErro('Mensagem não encontrada.', null);
        }


        $mensagem->nome = $request->nome;
        $mensagem->email = $request->email;
        $mensagem->assunto = $request->assunto;
        $mensagem->mensagem = $request->mensagem;

        $mensagem->save();

        return $this::enviarRespostaSucesso($mensagem, 'Mensagem alterada com sucesso', 200);
    }

    

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $mensagem = Mensagem::find($request->id);
        if(!$mensagem) {
            return $this::enviarRespostaErro('mensagem não encontrada.', null);
        }
        

        $mensagem->delete();

        return $this::enviarRespostaSucesso($mensagem, 'mensagem deletada com sucesso', 200);
    }

    public function index()
    {
        $mensagem = Mensagem::all();
       
            return $this::enviarRespostaSucesso($mensagem, 'Mensagens cadastradas', 200);
       
        
    }




    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaSucesso('Erro de validação.', $validator->errors());
        }

        $mensagem = Mensagem::find($request->id);
        if(!$mensagem) {
            return $this::enviarRespostaSucesso('Mensagem não encontrada.', null);
        }

        return $this::enviarRespostaSucesso($mensagem);
    }
}
