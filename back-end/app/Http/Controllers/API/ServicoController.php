<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Imagem;
use App\Servico;
use Illuminate\Support\Facades\Storage;

class ServicoController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagem_id' => 'required|integer',
            'servico' => 'required|max:255',
            'descricao' => 'max:500',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo incorreto.', $validator->errors());
        }

        $servico = new Servico;
        $servico->servico = $request->servico;
        $servico->descricao = $request->descricao;
        $servico->imagem_id = $request->imagem_id;

        $imagem = Imagem::find($request->imagem_id);
        if (!$imagem)
        {
            return $this::enviarRespostaErro('Imagem não encontrada');
        }

        $servico->imagem()->associate($imagem)->save();

        return $this::enviarRespostaSucesso($servico, 'Serviço cadastrado com sucesso', 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'imagem_id' => 'required|integer',
            'servico' => 'required|max:255',
            'descricao' => 'max:500',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $servico = Servico::find($request->id);
        if(!$servico) {
            return $this::enviarRespostaErro('Servico não encontrado.');
        }

        $imagem = Imagem::find($request->imagem_id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada.');
        }


        $servico->update($request->all());
        $servico->imagem()->associate($imagem)->save();
        
        return $this::enviarRespostaSucesso($servico, 'Servico alterado com sucesso', 200);
    }

    

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $servico = Servico::find($request->id);
        if(!$servico) {
            return $this::enviarRespostaErro('Serviço não encontrado.');
        }

        $servico->delete();

        return $this::enviarRespostaSucesso($servico, 'Serviço deletado com sucesso', 200);
    }

    public function index()
    {
        $servico = Servico::all();
       
            return $this::enviarRespostaSucesso($servico, 'Serviços cadastrados', 200);
     
        
    }




    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaSucesso('Erro de validação.', $validator->errors());
        }

        $servico = Servico::find($request->id);
        if(!$servico) {
            return $this::enviarRespostaSucesso('Serviço não encontrado.');
        }

        return $this::enviarRespostaSucesso($servico);
    }
}
