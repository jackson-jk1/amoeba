<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Imagem;
use Illuminate\Support\Facades\Storage;

class ImagemController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|max:255',
            'descricao' => 'max:500',
            'imagem' => 'required|image',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo incorreto.', $validator->errors());
        }

        $caminho = Storage::putFile('imagens', $request->file('imagem'), 'public');

        $imagem = Imagem::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'caminho' => $caminho,
        ]);

        $imagem->save();

        return $this::enviarRespostaSucesso($imagem, 'Imagem cadastrada com sucesso', 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'titulo' => 'required|max:255',
            'descricao' => 'max:500',
            'imagem' => 'required|image',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $imagem = Imagem::find($request->id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada.', null);
        }

        $caminho = Storage::putFile('imagens', $request->file('imagem'), 'public');

        $imagem->titulo = $request->titulo;
        $imagem->descricao = $request->descricao;
        $imagem->caminho = $caminho;

        $imagem->save();

        return $this::enviarRespostaSucesso($imagem, 'Imagem alterada com sucesso', 200);
    }

    

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $imagem = Imagem::find($request->id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada.', null);
        }

        if ($imagem->servico()->first()){
            return $this::enviarRespostaErro('Imagem está sendo usada.');
        }

        if ($imagem->portfolio()->first()){
            return $this::enviarRespostaErro('Imagem está sendo usada.');
        }

        if ($imagem->equipe()->first()){
            return $this::enviarRespostaErro('Imagem está sendo usada.');
        }

        Storage::delete($imagem->caminho);

        $imagem->delete();

        return $this::enviarRespostaSucesso($imagem, 'Imagem deletada com sucesso', 200);
    }

    public function index()
    {
        $imagem = Imagem::all();
     
            return $this::enviarRespostaSucesso($imagem, 'Imagens cadastradas', 200);
        
        
    }




    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaSucesso('Erro de validação.', $validator->errors());
        }

        $imagem = Imagem::find($request->id);
        if(!$imagem) {
            return $this::enviarRespostaSucesso('Imagem não encontrada.', null);
        }

        return $this::enviarRespostaSucesso($imagem);
    }
}
