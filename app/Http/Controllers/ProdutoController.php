<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Exibe o formulário para criar um novo produto.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Armazena um novo produto no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade_em_estoque' => 'required|integer|min:0',
        ]);

        // Criação do produto no banco de dados
        Produto::create([
            'nome' => $request->input('nome'),
            'categoria' => $request->input('categoria'),
            'preco' => $request->input('preco'),
            'quantidade_em_estoque' => $request->input('quantidade_em_estoque'),
        ]);

        // Redireciona para a página inicial ou outra página desejada
        return redirect()->route('home')->with('success', 'Produto criado com sucesso!');
    }
}
