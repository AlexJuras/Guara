<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contas = Conta::with('cliente')
            ->orderBy('data_vencimento', 'desc')
            ->paginate(15);

        return Inertia::render('Contas/Index', [
            'contas' => $contas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::where('status', true)
            ->orderBy('nome')
            ->get(['id', 'nome', 'razao_social']);

        return Inertia::render('Contas/Create', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'valor' => 'required|numeric|min:0.01',
            'tipo_movimentacao' => 'required|in:receber,pagar',
            'tipo_pagamento' => 'nullable|in:pix,transferencia,boleto,cartao,dinheiro',
            'status' => 'required|in:pendente,pago,atrasado,cancelado',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date',
            'descricao' => 'nullable|string|max:1000'
        ]);

        Conta::create($validated);

        return Redirect::route('contas.index')
            ->with('success', 'Conta criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conta $conta)
    {
        $conta->load('cliente');

        return Inertia::render('Contas/Show', [
            'conta' => $conta
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conta $conta)
    {
        $clientes = Cliente::where('status', true)
            ->orderBy('nome')
            ->get(['id', 'nome', 'razao_social']);

        return Inertia::render('Contas/Edit', [
            'conta' => $conta,
            'clientes' => $clientes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conta $conta)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'valor' => 'required|numeric|min:0.01',
            'tipo_movimentacao' => 'required|in:receber,pagar',
            'tipo_pagamento' => 'nullable|in:pix,transferencia,boleto,cartao,dinheiro',
            'status' => 'required|in:pendente,pago,atrasado,cancelado',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date',
            'descricao' => 'nullable|string|max:1000'
        ]);

        $conta->update($validated);

        return Redirect::route('contas.index')
            ->with('success', 'Conta atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conta $conta)
    {
        $conta->delete();

        return Redirect::route('contas.index')
            ->with('success', 'Conta excluída com sucesso!');
    }
}
