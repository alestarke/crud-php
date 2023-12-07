<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Exibe a lista de produtos.
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        // Recupera todos os produtos do banco de dados
        $produtos = Produto::all();

        // Retorna a view com os produtos
        return view('produtos.list', ['produtos' => $produtos]);
    }

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

    public function edit($id)
    {
        // Recupera o produto com ID $id do banco de dados
        $produto = Produto::findOrFail($id);

        // Retorna uma view de formulário de edição com o produto
        return view('produtos.edit', ['produto' => $produto]);
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade_em_estoque' => 'required|integer|min:0',
        ]);

        // Atualiza o produto no banco de dados
        Produto::where('id', $id)->update([
            'nome' => $request->input('nome'),
            'categoria' => $request->input('categoria'),
            'preco' => $request->input('preco'),
            'quantidade_em_estoque' => $request->input('quantidade_em_estoque'),
        ]);

        // Redireciona de volta para a lista de produtos ou outra página
        return redirect()->route('produtos.list')->with('success', 'Produto atualizado com sucesso!');
    }

    public function delete($id)
    {
        // Recupera o produto com ID $id do banco de dados
        $produto = Produto::findOrFail($id);

        // Exclui o produto do banco de dados
        $produto->delete();

        // Redireciona de volta para a lista de produtos ou outra página
        return redirect()->route('produtos.list')->with('success', 'Produto excluído com sucesso!');
    }
}
