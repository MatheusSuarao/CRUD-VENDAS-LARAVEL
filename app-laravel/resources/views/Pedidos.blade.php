@extends('layout.main')

@section('title', 'Pedidos')
    
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="my-4">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pedidoModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
            <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5"/>
            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
          </svg>
        Novo Pedido
      </button>
    
    <!-- Modal -->
    <div class="modal fade" id="pedidoModal" tabindex="-1" aria-labelledby="pedidoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="pedidoModalLabel">Cadastrar Pedido</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Formulário de criação de pedido -->
            <form action="{{ route('pedidos.cadastrar') }}" method="POST">
              @csrf
              <div class="modal-body">
                
                <!-- Seção do cliente -->


                <div class="form-floating mb-3">
                    <select class="form-select" name="id_cliente" id="floatingSelect" aria-label="Produto" required>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nome }}</option>
                      @endforeach
                    </select>
                    <label for="cliente" class="form-label">Cliente</label>
                </div>
                
                <!-- Seção para adicionar os itens do pedido -->
                <div id="itens-pedido">
                  <div class="item-pedido">
                    <div class="row">
                      <div class="col-md-5">
                        <label for="produto" class="form-label">Produto</label>
                        <select name="itens[0][id_produto]" class="form-control" required>
                          @foreach($produtos as $produto)
                            <option value="{{ $produto->id_produto }}">{{ $produto->nome }}</option>
                          @endforeach
                        </select>
                      </div>
      
                      <div class="col-md-3">
                        <label for="qtde" class="form-label">Quantidade</label>
                        <input type="number" name="itens[0][qtde]" class="form-control" required>
                      </div>
      
                      <div class="col-md-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" name="itens[0][preco]" class="form-control" required>
                      </div>
      
                      <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
                      </div>
                    </div>
                  </div>
                </div>
      
                <!-- Botão para adicionar mais itens -->
                <div class="my-3">
                  <button type="button" class="btn btn-success" id="add-item">Adicionar Item</button>
                </div>
      
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar Pedido</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        let itemIndex = 1;

            // Adicionar novo item
            document.getElementById('add-item').addEventListener('click', function () {
                const newItem = `
                    <div class="item-pedido">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="produto" class="form-label">Produto</label>
                                <select name="itens[${itemIndex}][id_produto]" class="form-control" required>
                                    @foreach($produtos as $produto)
                                        <option value="{{ $produto->id_produto }}">{{ $produto->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="qtde" class="form-label">Quantidade</label>
                                <input type="number" name="itens[${itemIndex}][qtde]" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label for="preco" class="form-label">Preço</label>
                                <input type="text" name="itens[${itemIndex}][preco]" class="form-control" required>
                            </div>

                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
                            </div>
                        </div>
                    </div>`;

                document.getElementById('itens-pedido').insertAdjacentHTML('beforeend', newItem);
                itemIndex++;
            });

            // Remover item
            document.getElementById('itens-pedido').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-item')) {
                    e.target.closest('.item-pedido').remove();
                }
            });
        });

    </script>

    
</div>


<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Cliente</th>
        <th scope="col">Data</th>
        <th scope="col" style="width:10%;">Açoes</th>
      </tr>
    </thead>
    <tbody>

        @if (isset($pedidos))
            @foreach ($pedidos as $item)
                <tr>
                    <td>{{ $item->id_pedido }}</td>
                    <td>{{ $item->cliente['nome'] }}</td>
                    <td>{{ $item->data }}</td>
                    <td>

                        <div class="d-flex gap-4">
                            <a href="javascript:void(0)" 
                                class="edit-pedido" 
                                data-id="{{ $item->id_pedido }}" 
                                data-date="{{ $item->data }}" 
                                data-id-cliente="{{ $item->cliente['id_cliente'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </a>
                         
                
                            <a href="{{ route('pedidos.excluir', $item->id_pedido) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                  </svg>
                            </a>
                        </div>

                    </td>
                </tr>
            @endforeach
        @endif

    
    </tbody>
  </table>

<!-- Modal -->
<div class="modal fade" id="modalEditPedido" tabindex="-1" aria-labelledby="modalEditPedidoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPedidoLabel">Editar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="pedidoEdit" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Floating input para o cliente do pedido -->
                    <div class="form-floating mb-3">
                        <select id="pedidoCliente" name="id_cliente" class="form-select" required>

                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                        <label for="pedidoCliente">Cliente</label>
                    </div>

                    <!-- Seção para os itens do pedido (preenchido dinamicamente) -->
                    <div id="itens-pedido1">
                        <!-- Aqui os itens do pedido serão carregados dinamicamente -->
                    </div>

                    <div class="my-3">
                        <button type="button" class="btn btn-success" id="add-item1">Adicionar Item</button>
                      </div>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        
        // Quando o usuário clicar no botão de editar pedido
        document.querySelectorAll('.edit-pedido').forEach(button => {
            button.addEventListener('click', function() {
                const pedidoId = this.getAttribute('data-id');
                
                // Define a rota correta para o formulário de edição de pedido
                const formAction = `/pedidos/atualizar/${pedidoId}`;
                document.getElementById('pedidoEdit').action = formAction;


                // Fazer requisição para obter os itens do pedido
                fetch(`/pedidos/${pedidoId}/itens`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Aqui você verá o JSON retornado no console

                        // Limpar os itens existentes na modal ou na tela, se houver
                        const itensContainer = document.getElementById('itens-pedido1');
                        itensContainer.innerHTML = '';  // Limpa os itens existentes

                        // Iterar sobre os itens e adicioná-los ao container da página ou modal
                        data.forEach((item, index) => {
                            const newItem = `
                                <div class="item-pedido">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="produto" class="form-label">Produto</label>
                                            <select name="itens[${index}][id_produto]" class="form-control" required>
                                                <option value="${item.id_produto}" selected>${item.nome_produto}</option>
                                                <!-- Aqui você pode adicionar outras opções de produtos se necessário -->
                                            </select>
                                        </div>
                
                                        <div class="col-md-3">
                                            <label for="qtde" class="form-label">Quantidade</label>
                                            <input type="number" name="itens[${index}][qtde]" class="form-control" value="${item.qtde}" required>
                                        </div>
                
                                        <div class="col-md-3">
                                            <label for="preco" class="form-label">Preço</label>
                                            <input type="text" name="itens[${index}][preco]" class="form-control" value="${item.preco}" required>
                                        </div>
                
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
                                        </div>
                                    </div>
                                </div>
                            `;

                            itensContainer.insertAdjacentHTML('beforeend', newItem);
                        });

                        // Agora que os itens foram carregados, exiba a modal de edição
                        const modal = new bootstrap.Modal(document.getElementById('modalEditPedido'));
                        modal.show();
                    })
                    .catch(error => {
                        console.error('Erro ao buscar itens do pedido:', error);
                    });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        let itemIndex = 1;

            // Adicionar novo item
            document.getElementById('add-item1').addEventListener('click', function () {
                const newItem = `
                    <div class="item-pedido">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="produto" class="form-label">Produto</label>
                                <select name="itens[${itemIndex}][id_produto]" class="form-control" required>
                                    @foreach($produtos as $produto)
                                        <option value="{{ $produto->id_produto }}">{{ $produto->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="qtde" class="form-label">Quantidade</label>
                                <input type="number" name="itens[${itemIndex}][qtde]" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label for="preco" class="form-label">Preço</label>
                                <input type="text" name="itens[${itemIndex}][preco]" class="form-control" required>
                            </div>

                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
                            </div>
                        </div>
                    </div>`;

                document.getElementById('itens-pedido1').insertAdjacentHTML('beforeend', newItem);
                itemIndex++;
            });

            // Remover item
            document.getElementById('itens-pedido1').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-item')) {
                    e.target.closest('.item-pedido').remove();
                }
            });
        });
</script>
  
  


  

@endsection