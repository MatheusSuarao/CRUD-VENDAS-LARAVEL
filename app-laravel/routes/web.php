<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

//Rotas Produtos
Route::match(['get', 'post'],'/', [ProdutoController::class, 'index'])
    ->name('Produtos');

Route::match(['get', 'post'],'/produto/cadastrar', [ProdutoController::class, 'cadastrar'])
    ->name('Cadastrar');

Route::get('/produtos/excluir/{id}', [ProdutoController::class, 'excluir'])
    ->name('Excluir');

Route::put('/produtos/atualizar/{id}', [ProdutoController::class, 'atualizar'])
    ->name('Atualizar');

//Rotas Cliente
Route::match(['get', 'post'],'/clientes', [ClienteController::class, 'lista'])
    ->name('Clientes');

Route::match(['get', 'post'],'/cliente/cadastrar', [ClienteController::class, 'cadastrar'])
    ->name('cliente.cadastrar');

Route::get('/cliente/excluir/{id}', [ClienteController::class, 'excluir'])
    ->name('cliente.excluir');

Route::put('/cliente/atualizar/{id}', [ClienteController::class, 'atualizar'])
    ->name('cliente.atualizar');


//Rotas Pedido
Route::match(['get', 'post'],'/pedidos', [PedidosController::class, 'lista'])
    ->name('Pedidos');
    
Route::match(['get', 'post'],'/pedidos/cadastrar', [PedidosController::class, 'criar'])
    ->name('pedidos.criar');

Route::match(['get', 'post'],'/pedidos/salvar', [PedidosController::class, 'cadastrar'])
    ->name('pedidos.cadastrar');

Route::get('/pedidos/excluir/{id}', [PedidosController::class, 'excluir'])
    ->name('pedidos.excluir');

Route::put('/pedidos/atualizar/{id}', [PedidosController::class, 'atualizar'])
    ->name('pedidos.atualizar');

    //Carrega os itens para atualizar
Route::get('/pedidos/{id}/itens', [PedidosController::class, 'getItens']);
