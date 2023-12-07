@extends('master')

@section('content')

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
            <input type="money_format" name="preco" step="0.01" required>
            <br>
            <label for="quantidade_em_estoque">Quantidade em Estoque:</label>
            <input type="number" name="quantidade_em_estoque" required>
            <br>
            <button type="submit">Criar Produto</button>
        </form>

@endsection