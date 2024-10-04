<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PedidosController extends Controller
{
        //Lista os Pedidos no bd
     public function lista(Request $request){
    
        //Buscando Produtos
        $pedidos = Pedido::all();

        // Recupera todos os clientes
        $clientes = Cliente::all();
    
        // Recupera todos os produtos
        $produtos = Produto::all();
    
        return view('Pedidos', compact('clientes', 'pedidos', 'produtos'));
    
        }

        //Cria o pedido e carrega o form
        public function criar()
        {
            // Recupera todos os clientes
            $clientes = Cliente::all();
    
            // Recupera todos os produtos
            $produtos = Produto::all();
    
            // Retorna a view com as variáveis clientes e produtos
            return view('Pedidos', compact('clientes', 'produtos'));
        }

        //Realiza cadastro depois de validados 
        public function cadastrar(Request $request)
        {
            // Validação dos dados do pedido e dos itens
            $validatedData = $request->validate([
                'id_cliente' => 'required|exists:clientes,id_cliente', // Pedido está ligado a um cliente
                'itens' => 'required|array',
                'itens.*.id_produto' => 'required|exists:produtos,id_produto',
                'itens.*.qtde' => 'required|integer|min:1',
                'itens.*.preco' => 'required|numeric',
            ]);
    
            // Cria o pedido
            $pedido = Pedido::create([
                'id_cliente' => $validatedData['id_cliente'],
                'data' => now(), // Define a data atual como a data do pedido
            ]);
    
            // Adiciona os itens do pedido
            foreach ($validatedData['itens'] as $item) {
                PedidoItem::create([
                    'id_pedido' => $pedido->id_pedido, // Liga o item ao pedido criado
                    'id_produto' => $item['id_produto'],
                    'qtde' => $item['qtde'],
                    'preco' => $item['preco'],
                ]);
            }
    
            // Retorna uma resposta de sucesso
            return redirect()->route('Pedidos')->with('success', 'Pedido criado com sucesso!');
        }

        public function excluir($id)
        {
            // Buscar o pedido pelo ID
            $pedido = Pedido::find($id);
    
            // Excluir o pedido
            $pedido->delete();
    
            // Redirecionar de volta à lista com uma mensagem de sucesso
            return redirect()->route('Pedidos')
                             ->with('success', 'Pedido excluído com sucesso!');
        }

        public function atualizar(Request $request, $id)
        {
            // Valida os dados da requisição
            $request->validate([
                'id_cliente' => 'required|exists:clientes,id_cliente',
                'itens.*.id_produto' => 'required|exists:produtos,id_produto',
                'itens.*.qtde' => 'required|integer|min:1',
                'itens.*.preco' => 'required|numeric|min:0',
            ]);
        
            // Obtém o pedido que será atualizado
            $pedido = Pedido::findOrFail($id);
            $pedido->id_cliente = $request->id_cliente; 
            $pedido->data = now();
            $pedido->save(); 
        
            // Atualiza os itens do pedido
            foreach ($request->itens as $item) {
                // Atualiza o item existente ou cria um novo, caso não exista
                PedidoItem::updateOrCreate(
                    ['id_pedido' => $pedido->id_pedido, 'id_produto' => $item['id_produto']], // Condição para buscar o item
                    [
                        'qtde' => $item['qtde'],
                        'preco' => $item['preco']
                    ]
                );
            }
        
            // Redireciona com uma mensagem de sucesso
            return redirect()->route('Pedidos')->with('success', 'Pedido atualizado com sucesso!');
        }
        

        public function getItens($id)
        {
            $itens = Pedido::with('itens.produto') // Carrega os produtos relacionados aos itens do pedido
                           ->find($id)
                           ->itens;
        
            // Crie uma estrutura com o id do produto e o nome do produto para retornar via JSON
            $itensFormatados = $itens->map(function($item) {
                return [
                    'id_produto' => $item->produto->id_produto, // ID do produto
                    'nome_produto' => $item->produto->nome,    // Nome do produto
                    'qtde' => $item->qtde,                     // Quantidade do item
                    'preco' => $item->preco                    // Preço do item
                ];
            });
        
            return response()->json($itensFormatados); // Retorna o JSON formatado
        }
        
}
