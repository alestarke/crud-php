@extends('master')

@section('create-product')

<h2>Criar Novo Produto</h2>
        <form method="POST" action="{{ route('produtos.store') }}">
            @csrf
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>
            <br>
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" required>
            <br>
            <label for="preco">Preço:</label>
            <input type="number" name="preco" step="0.01" required>
            <br>
            <label for="quantidade_em_estoque">Quantidade em Estoque:</label>
            <input type="number" name="quantidade_em_estoque" required>
            <br>
            <button type="submit">Criar Produto</button>
        </form>

@endsection

@section('list-product')
    <h2>Lista de Produtos</h2>
    <table id="produtos-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quantidade em Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr data-produto-id="{{ $produto->id }}">
                    <td>{{ $produto->id }}</td>
                    <td class="editable editable-nome" contenteditable="true">{{ $produto->nome }}</td>
                    <td class="editable editable-categoria" contenteditable="true">{{ $produto->categoria }}</td>
                    <td class="editable editable-preco" contenteditable="true">{{ $produto->preco }}</td>
                    <td class="editable editable-quantidade" contenteditable="true">{{ $produto->quantidade_em_estoque }}</td>
                    <td>
                        <button class="edit-btn">Editar</button>
                        <button class="update-btn" style="display:none;">Atualizar</button>
                        <button class="delete-btn" data-produto-id="{{ $produto->id }}">Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Habilita a edição ao clicar no botão Editar
            $('.edit-btn').on('click', function() {
                var row = $(this).closest('tr');
                row.find('.editable').attr('contenteditable', 'true');
                row.find('.edit-btn').hide();
                row.find('.update-btn').show();
            });

            // Atualiza os dados ao clicar no botão Atualizar
            $('.update-btn').on('click', function() {
                var row = $(this).closest('tr');

                // Coleta os dados atualizados dos campos editáveis
                var updatedData = {
                    nome: row.find('.editable-nome').text(),
                    categoria: row.find('.editable-categoria').text(),
                    preco: row.find('.editable-preco').text(),
                    quantidade_em_estoque: row.find('.editable-quantidade').text(),
                };

                // Envia os dados atualizados para o servidor via Ajax
                $.ajax({
                    url: '/produtos/' + row.data('produto-id'),
                    type: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ...updatedData,
                    },
                    success: function(response) {
                        // Aguarda 1 segundo antes de recarregar a página
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        // Lógica para lidar com erros, se necessário
                        console.error('Erro ao atualizar:', error);
                    }
                });

                // Restaura o estado dos elementos HTML
                row.find('.editable').attr('contenteditable', 'false');
                row.find('.edit-btn').show();
                row.find('.update-btn').hide();
            });

            // Adiciona ação de exclusão ao clicar no botão Excluir
            $('.delete-btn').on('click', function(e) {
                e.preventDefault(); // Impede o comportamento padrão do link

                const produtoId = $(this).data('produto-id');
                const deleteUrl = '{{ route('produtos.delete', ['id' => '__produto_id__']) }}'.replace('__produto_id__', produtoId);

                // Pergunta ao usuário se realmente deseja excluir
                if (confirm('Tem certeza que deseja excluir?')) {
                    // Chama a rota de exclusão via Ajax
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Aguarda 1 segundo antes de recarregar a página
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        },
                        error: function(error) {
                            console.error('Erro ao excluir produto:', error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
