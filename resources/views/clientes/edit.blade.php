@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('clientes.index') }}" class="p-2 bg-white rounded-xl border border-slate-200 text-slate-400 hover:text-red-600 transition-all">
            <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-800">Editar Cliente</h1>
            <p class="text-slate-500 text-sm">Atualize as informações de {{ $cliente->nome }}</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Razão Social --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase mb-2">Razão Social / Nome</label>
                    <input type="text" name="nome" value="{{ $cliente->nome }}" required class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 outline-none focus:ring-2 focus:ring-red-500">
                </div>

                {{-- CNPJ --}}
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase mb-2">CNPJ</label>
                    <input type="text" name="cnpj" value="{{ $cliente->cnpj }}" required class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 outline-none focus:ring-2 focus:ring-red-500">
                </div>

                {{-- Contrato --}}
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase mb-2">Contrato</label>
                    <select name="contrato" required class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 outline-none focus:ring-2 focus:ring-red-500 font-bold text-slate-700">
                        @foreach(['Alucom', 'Moreia', 'ZapLok'] as $opção)
                            <option value="{{ $opção }}" {{ $cliente->contrato == $opção ? 'selected' : '' }}>{{ $opção }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Endereço --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase mb-2">Endereço Completo</label>
                    <input type="text" name="endereco" value="{{ $cliente->endereco }}" required class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 outline-none focus:ring-2 focus:ring-red-500">
                </div>

                {{-- Estado e Cidade --}}
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase mb-2">UF</label>
                    <input type="text" name="estado" value="{{ $cliente->estado }}" required maxlength="2" class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 outline-none focus:ring-2 focus:ring-red-500 text-center uppercase">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase mb-2">Cidade</label>
                    <input type="text" name="cidade" value="{{ $cliente->cidade }}" required class="w-full rounded-xl border-slate-200 bg-slate-50 p-3 outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>

            {{-- SLA --}}
            <div class="pt-6 border-t border-slate-100">
                <p class="text-[10px] font-black text-red-600 uppercase tracking-widest mb-4">Configurações de SLA (Horas)</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php 
                        $slas = ['Atendimento' => 4, 'Insumos' => 24, 'Substituição' => 48, 'Remanejamento' => 72];
                    @endphp
                    
                    @foreach($slas as $label => $default)
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-1">{{ $label }}</label>
                        <input type="number" name="sla[{{ $label }}]" value="{{ $cliente->sla[$label] ?? $default }}" class="w-full rounded-lg border-slate-200 bg-slate-50 p-2 outline-none focus:ring-2 focus:ring-red-500 text-sm">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('clientes.index') }}" class="px-6 py-3 font-bold text-slate-500 hover:text-slate-700 transition-all">Cancelar</a>
                <button type="submit" class="px-10 py-3 font-black text-white bg-red-600 rounded-xl shadow-lg shadow-red-200 hover:bg-red-700 transition-all">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection