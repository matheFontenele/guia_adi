<?php

namespace App\Http\Controllers;

use App\Models\Tecnicos;
use Illuminate\Http\Request;

class TecnicosController extends Controller
{
    public function index(Request $request)
    {
        $query = Tecnicos::query();

        if ($request->filled('search')) {
            $query->where('nome', 'like', "%{$request->search}%")
                ->orWhere('regiao', 'like', "%{$request->search}%");
        }

        $tecnicos = $query->orderBy('nome')->get();
        return view('tecnicos.index', compact('tecnicos'));
    }

    //Função para exibir tecnicos 
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'cnpj' => 'nullable|string',
            'regiao' => 'required|string',
            'tipo' => 'required|in:Impressoras,Informatica,Ambos',
            'preco_atendimento' => 'required|numeric',
            'contato' => 'required|string',
        ]);

        Tecnicos::create($data);
        return redirect()->route('tecnicos.index')->with('success', 'Técnico cadastrado!');
    }

    // 1. Método para abrir a tela de Cadastro (O que causou o erro)
    public function create()
    {
        return view('tecnicos.create');
    }

    // 2. Método para abrir a tela de Edição
    public function edit($id)
    {
        $tecnico = Tecnicos::findOrFail($id);
        return view('tecnicos.edit', compact('tecnico'));
    }

    // 3. Método para salvar a atualização (Update)
    public function update(Request $request, $id)
    {
        $tecnico = Tecnicos::findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string',
            'cnpj' => 'nullable|string',
            'regiao' => 'required|string',
            'tipo' => 'required|in:Impressoras,Informatica,Ambos',
            'preco_atendimento' => 'required|numeric',
            'contato' => 'required|string',
        ]);

        $tecnico->update($data);

        return redirect()->route('tecnicos.index')->with('success', 'Técnico atualizado com sucesso!');
    }

    public function show($id)
    {
        // Busca o técnico no banco pelo ID ou retorna erro 404 se não existir
        $tecnico = \App\Models\Tecnicos::findOrFail($id);

        // Retorna a view 'tecnicos.show' passando os dados do técnico
        return view('tecnicos.show', compact('tecnico'));
    }
}
