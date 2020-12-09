<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('novoImagem', 'API\ImagemController@store');
Route::post('atualizarImagem', 'API\ImagemController@update');
Route::post('deletarImagem', 'API\ImagemController@destroy');
Route::post('imagem', 'API\ImagemController@show');
Route::get('imagens', 'API\ImagemController@index');


Route::post('novoServico', 'API\ServicoController@store');
Route::post('atualizarServico', 'API\ServicoController@update');
Route::post('deletarServico', 'API\ServicoController@destroy');
Route::post('servico', 'API\ServicoController@show');
Route::get('servicos', 'API\ServicoController@index');


Route::post('novoCategoria', 'API\CategoriaController@store');
Route::post('atualizarCategoria', 'API\CategoriaController@update');
Route::post('deletarCategoria', 'API\CategoriaController@destroy');
Route::post('categoria', 'API\CategoriaController@show');
Route::get('categorias', 'API\CategoriaController@index');


Route::post('novoPortfolio', 'API\PortfolioController@store');
Route::post('atualizarPortfolio', 'API\PortfolioController@update');
Route::post('deletarPortfolio', 'API\PortfolioController@destroy');
Route::post('portfolio', 'API\PortfolioController@show');
Route::get('portfolios', 'API\PortfolioController@index');

Route::post('novoEquipe', 'API\EquipeController@store');
Route::post('atualizarEquipe', 'API\EquipeController@update');
Route::post('deletarEquipe', 'API\EquipeController@destroy');
Route::post('equipe', 'API\EquipeController@show');
Route::get('equipes', 'API\EquipeController@index');


Route::post('novoContato', 'API\ContatoController@store');
Route::post('atualizarContato', 'API\ContatoController@update');
Route::post('deletarContato', 'API\ContatoController@destroy');
Route::post('contato', 'API\ContatoController@show');
Route::get('contatos', 'API\ContatoController@index');

Route::post('novoMensagem', 'API\MensagemController@store');
Route::post('atualizarMensagem', 'API\MensagemController@update');
Route::post('deletarMensagem', 'API\MensagemController@destroy');
Route::post('mensagem', 'API\MensagemController@show');
Route::get('mensagens', 'API\MensagemController@index');


/*
Route::post('login', 'AuthController@login')->name('login');
Route::post('registro', 'AuthController@registro')->name('registro');

Route::get('arquivos/{arquivo}', 'ArquivoController@show');


Route::middleware(['auth:api'])->group(function () {

    Route::get('meu-perfil', 'AuthController@meuPerfil')->name('perfil');

    Route::apiResource('arquivos', 'ArquivoController')->except([
        'show'
    ]);

});

Route::get('teste', function(){
    return 'abc';
});*/

