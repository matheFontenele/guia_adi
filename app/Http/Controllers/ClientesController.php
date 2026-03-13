<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    //Função principal
    public function index(Request $request)
    {
        $query = Clientes::query()->whereNull('parent_id'); // Mostra apenas os "Pais" (Ministérios)

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nome', 'like', "%{$search}%")
                ->orWhere('cnpj', 'like', "%{$search}%");
        }

        $clientes = $query->orderBy('nome')->get();
        return view('clientes.index', compact('clientes'));
    }

    //Função para mostrar os clientes 
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'      => 'required|string|max:255',
            'cnpj'      => 'required|string|unique:clientes,cnpj',
            'estado'    => 'required|string|max:2',
            'cidade'    => 'required|string|max:255',
            'endereco'  => 'required|string|max:255',
            'contrato'  => 'required|in:Alucom,Moreia,ZapLok',
            'sla'       => 'nullable|array',
            'parent_id' => 'nullable|exists:clientes,id', // Valida se o pai existe
            'tipo'      => 'required|in:ministerio,unidade',
        ]);

        Clientes::create($data);

        // Se for unidade, volta para o ministério pai, se não, volta para a lista
        if ($request->filled('parent_id')) {
            return redirect()->route('clientes.show', $request->parent_id)->with('success', 'Unidade cadastrada!');
        }

        return redirect()->route('clientes.index')->with('success', 'Ministério cadastrado!');
    }

    //Metedo para criar novo cliente
    public function create()
    {
        $ministerios = Clientes::whereNull('parent_id')->get();
        return view('clientes.create', compact('ministerios'));
    }

    // Adicione o método edit
    public function edit($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    //Metodo para atualizar dados de clientes (editar)
    public function update(Request $request, $id)
    {
        $cliente = Clientes::findOrFail($id);

        $data = $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'required|string|unique:clientes,cnpj,' . $id,
            'estado'   => 'required|string|max:2',
            'cidade'   => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'contrato' => 'required|in:Alucom,Moreia,ZapLok',
            'sla'      => 'nullable|array',
        ]);

        $cliente->update($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function show($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function destroy($id)
    {
        $cliente = Clientes::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente removido!');
    }
}
