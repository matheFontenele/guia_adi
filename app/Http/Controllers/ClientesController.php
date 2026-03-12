<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $query = Clientes::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nome', 'like', "%{$search}%")
                  ->orWhere('cnpj', 'like', "%{$search}%");
        }

        $clientes = $query->orderBy('nome')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'required|string|unique:clientes,cnpj',
            'estado'   => 'required|string|max:2',
            'cidade'   => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'contrato' => 'required|in:Alucom,Moreia,ZapLok',
            'sla'      => 'nullable|array',
        ]);

        Clientes::create($data);

        return back()->with('success', 'Cliente cadastrado com sucesso!');
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