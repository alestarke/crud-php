<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; // Certifique-se de importar o modelo Produto

class HomeController extends Controller
{
    public function index()
    {
        // Recupera todos os produtos do banco de dados
        $produtos = Produto::all();

        // Retorna a view 'home' com a variável $produtos
        return view('home', ['produtos' => $produtos]);
    }
}
