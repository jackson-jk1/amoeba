<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Imagem;
use App\Categoria;
use App\Portfolio;
use Illuminate\Support\Facades\Storage;


class PortfolioController extends BaseController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagem_id' => 'required|integer',
            'link' => 'required|active_url',
            'categoria_id' => 'required|array',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Campo incorreto.', $validator->errors());
        }


        $imagem = Imagem::find($request->imagem_id);
        if (!$imagem)
        {
            return $this::enviarRespostaErro('Imagem não encontrada');
        }

        foreach ($request->categoria_id as $categoria_id )
        {
            $categoria = Categoria::find($categoria_id);
            if (!$categoria)
            {
                return $this::enviarRespostaErro('Categoria não encontrada');
            }
        }
        
     
        $portfolio = new Portfolio;
        $portfolio->link = $request->link;
        $portfolio->imagem()->associate($request->imagem_id)->save();
        $portfolio->categoria()->attach($request->categoria_id);
        $portfolio->save();

        return $this::enviarRespostaSucesso($portfolio, 'Portfolio cadastrado com sucesso', 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'imagem_id' => 'required|integer',
            'link' => 'required|active_url',
            'categoria_id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $portfolio = Portfolio::find($request->id);
        if(!$portfolio) {
            return $this::enviarRespostaErro('Portfolio não encontrado.');
        }

        foreach ($request->categoria_id as $categoria_id){
            $categoria = Categoria::find($categoria_id);
            if (!$categoria){
                return $this::enviarRespostaErro('Categoria não encontrada');
            }
        }

        $imagem = Imagem::find($request->imagem_id);
        if(!$imagem) {
            return $this::enviarRespostaErro('Imagem não encontrada.');
        }

        $portfolio->update($request->all());
        $portfolio->imagem()->associate($request->imagem_id)->save();
        $portfolio->categoria()->sync($request->categoria_id);
        $portfolio->save();
        
        return $this::enviarRespostaSucesso($portfolio, 'Portfolio alterado com sucesso', 200);
    }

    

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaErro('Erro de validação.', $validator->errors());
        }

        $portfolio = Portfolio::find($request->id);
        if(!$portfolio) {
            return $this::enviarRespostaErro('Portfolio não encontrado.');
        }

        $portfolio->categoria()->detach();
        $portfolio->delete();

        return $this::enviarRespostaSucesso($portfolio, 'Portfolio deletado com sucesso', 200);
    }

    public function index()
    {
        $portfolio = Portfolio::all();
      
            return $this::enviarRespostaSucesso($portfolio, 'Portfolios cadastrados', 200);
       
    
    }




    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()){
            return $this::enviarRespostaSucesso('Erro de validação.', $validator->errors());
        }

        $portfolio = Portfolio::find($request->id);
        if(!$portfolio) {
            return $this::enviarRespostaSucesso('Portfolio não encontrado.');
        }

        return $this::enviarRespostaSucesso($portfolio);
    }
}
