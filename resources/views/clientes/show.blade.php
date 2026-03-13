@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('clientes.index') }}" class="p-3 bg-white rounded-2xl border border-slate-200 text-slate-400 hover:text-slate-600 shadow-sm transition-all">
            <i class="ph ph-arrow-left font-bold"></i>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-800">{{ $cliente->nome }}</h1>
            <p class="text-slate-500 text-sm">Detalhes completos do cliente e ativos alocados.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-xl border border-slate-200">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-wider mb-4">Dados Cadastrais</h3>

                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase">CNPJ</p>
                        <p class="font-bold text-slate-700">{{ $cliente->cnpj }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase">Contrato Ativo</p>
                        <span class="inline-block mt-1 px-3 py-1 bg-slate-100 text-slate-700 rounded-lg font-black text-xs uppercase">
                            {{ $cliente->contrato ?? 'Não Informado' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase">Localização</p>
                        <p class="font-bold text-slate-700">{{ $cliente->endereco }} - {{ $cliente->cidade }} - {{ $cliente->estado }}</p>
                    </div>
                    <div class="pt-4 border-t border-slate-100">
                        <p class="text-[10px] font-black text-slate-400 uppercase mb-2">Tempo de SLA</p>
                        <div class="p-3 bg-slate-50 rounded-xl text-sm text-slate-600 leading-relaxed italic">
                            <p><strong>SLA de Atendimento:</strong> {{ $cliente->sla['Atendimento'] ?? 'N/D' }}h</p>
                            <p><strong>SLA de Insumos:</strong> {{ $cliente->sla['Insumos'] ?? 'N/D' }}h</p>
                            <p><strong>SLA de Substituição:</strong> {{ $cliente->sla['Substituição'] ?? 'N/D' }}h</p>
                            <p><strong>SLA de Remanejamento:</strong> {{ $cliente->sla['Remanejamento'] ?? 'N/D' }}h</p>
                            <p><strong>Tipos de Insumos:</strong> {{ $cliente->sla['Tipo'] ?? 'N/D' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if($cliente->tipo == 'ministerio')
<div class="mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-black text-slate-800 tracking-tight">Unidades Vinculadas</h2>
        <a href="{{ route('clientes.create', ['parent_id' => $cliente->id]) }}" class="bg-slate-800 text-white text-xs px-4 py-2 rounded-lg font-bold hover:bg-slate-700 transition-all">
            + Adicionar Unidade
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase">Nome da Unidade</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase">Cidade/UF</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($cliente->unidades as $unidade)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-bold text-slate-700">{{ $unidade->nome }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $unidade->cidade }} - {{ $unidade->estado }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('clientes.show', $unidade->id) }}" class="text-red-600 font-black text-xs uppercase hover:underline">Ver Detalhes</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-slate-400 italic text-sm">Nenhuma unidade cadastrada para este ministério.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection