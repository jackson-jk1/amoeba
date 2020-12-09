<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Imagem;
use App\Equipe;
use Illuminate\Support\Facades\Storage;

class EquipeController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagem_id' => 'required|integer',
            'nome' => 'required|max:255',
            'cargo' => 'required|max:255',
            'descricao' => 'max:500',
            'twitter_link' => 'required|active_url',
            'facebook_link' => 'required|active_url',
            'instagram_link' => 'required|active_url',
            'linkedin_link' => 'required|active_url',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo incorreto.', $validator->errors());
        }

        $equipe = new Equipe;
        $equipe->nome = $request->nome;
        $equipe->cargo = $request->cargo;
        $equipe->descricao = $request->descricao;
        $equipe->imagem_id = $request->imagem_id;
        $equipe->twitter_link = $request->twitter_link;
        $equipe->facebook_link = $request->facebook_link;
        $equipe->instagram_link = $request->instagram_link;
        $equipe->linkedin_link = $request->linkedin_link;

        $imagem = Imagem::find($request->imagem_id);
        if (!$imagem)
        {
            return $this::enviarRespostaErro('Imagem não encontrada');
        }

        $equipe->imagem()->associate($imagem)->save();

        return $this::enviarRespostaSucesso($equipe, 'Equipe cadastrado com sucesso', 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagem_id' => 'required|integer',
            'nome' => 'required|max:255',
            'cargo' => 'required|max:255',
            'descricao' => 'max:500',
            'twitter_link' => 'required|active_url',
            'facebook_link' => 'required|active_url',
            'instagram_link' => 'required|active_url',
            'linkedin_link' => 'required|active_url',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $equipe = Equipe::find($request->id);
        if(!$equipe) {
            return $this::enviarRespostaErro('equipe não encontrado.');
        }

        $imagem = Imagem::find($request->imagem_id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada.');
        }


        $equipe->update($request->all());
        $equipe->imagem()->associate($imagem)->save();
        
        return $this::enviarRespostaSucesso($equipe, 'equipe alterada com sucesso', 200);
    }

    

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $equipe = Equipe::find($request->id);
        if(!$equipe) {
            return $this::enviarRespostaErro('Equipe não encontrada.');
        }

        $equipe->delete();

        return $this::enviarRespostaSucesso($equipe, 'Equipe deletada com sucesso', 200);
    }

    public function index()
    {
        $equipe = Equipe::all();
        
            return $this::enviarRespostaSucesso($equipe, 'Equipes cadastradas', 200);
        

    }




    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaSucesso('Erro de validação.', $validator->errors());
        }

        $equipe = Equipe::find($request->id);
        if(!$equipe) {
            return $this::enviarRespostaSucesso('Equipe não encontrada.');
        }

        return $this::enviarRespostaSucesso($equipe);
    }
}

