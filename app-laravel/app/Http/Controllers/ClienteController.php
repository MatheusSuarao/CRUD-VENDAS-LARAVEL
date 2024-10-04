<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
        //Lista os Clientes no bd
        public function lista(Request $request){
            $lista = [];
    
            //Buscando Produtos
            $listaProd = Cliente::all();
            $lista['clientes'] = $listaProd;
    
            return view('clientes', $lista);
    
        }



    public function cadastrar(Request $request)
        {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);
    
        // Criar o produto
        $produto = Cliente::create([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);
    
        // Redireciona com a mensagem de sucesso
        return redirect()->route('Clientes')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }


        //Atualiza o produto
    public function atualizar(Request $request, $id)
{
    // Valida os dados do formulário
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|string|max:255',
    ]);

    // Encontra o produto pelo ID
    $cliente = Cliente::find($id);

    if ($cliente) {
        // Atualiza os dados do cliente
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->save();

        // Redireciona de volta para a lista de clientes com mensagem de sucesso
        return redirect()->route('Clientes')->with('success', 'Cliente atualizado com sucesso!');
    }

    // Retorna com erro se o cliente não for encontrado
    return redirect()->route('Clientes')->with('error', 'Cliente não encontrado!');
    }


    //Apaga o cliente com base no id
    public function excluir($id)
    {
        // Buscar o cliente pelo ID
        $cliente = Cliente::find($id);

        // Excluir o cliente
        $cliente->delete();

        // Redirecionar de volta à lista com uma mensagem de sucesso
        return redirect()->route('Clientes')
                         ->with('success', 'Cliente excluído com sucesso!');
    }
}
