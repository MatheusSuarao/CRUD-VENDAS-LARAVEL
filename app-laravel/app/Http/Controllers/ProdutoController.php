<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    //Lista os Produtos no bd
    public function index(Request $request){
        $lista = [];

        //Buscando Produtos
        $listaProd = Produto::all();
        $lista['produtos'] = $listaProd;

        return view('produtos', $lista);

    }

    //Faz o cadastro do produto
    public function cadastrar(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
        ]);

        // Criar o produto
        $produto = Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        // Redireciona com a mensagem de sucesso
        return redirect()->route('Produtos')
                         ->with('success', 'Produto cadastrado com sucesso!');
    }

    //Apaga o produto com base no id
    public function excluir($id)
    {
        // Buscar o produto pelo ID
        $produto = Produto::find($id);

        // Excluir o produto
        $produto->delete();

        // Redirecionar de volta à lista com uma mensagem de sucesso
        return redirect()->route('Produtos')
                         ->with('success', 'Produto excluído com sucesso!');
    }


    //Atualiza o produto
    public function atualizar(Request $request, $id)
{
    // Valida os dados do formulário
    $request->validate([
        'nome' => 'required|string|max:255',
        'preco' => 'required|numeric',
    ]);

    // Encontra o produto pelo ID
    $produto = Produto::find($id);

    if ($produto) {
        // Atualiza os dados do produto
        $produto->nome = $request->input('nome');
        $produto->preco = $request->input('preco');
        $produto->save();

        // Redireciona de volta para a lista de produtos com mensagem de sucesso
        return redirect()->route('Produtos')->with('success', 'Produto atualizado com sucesso!');
    }

    // Retorna com erro se o produto não for encontrado
    return redirect()->route('Produtos')->with('error', 'Produto não encontrado!');
}

    
}
