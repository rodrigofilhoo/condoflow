<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    /**
     * Listar veículos
     */
    public function index()
    {
        return view('veiculos.index');
    }

    /**
     * Formulário de novo veículo
     */
    public function create()
    {
        return view('veiculos.create');
    }

    /**
     * Criar veículo
     */
    public function store(Request $request)
    {
        // Implementar lógica de criação de veículo
        return redirect()->route('veiculos.index')->with('success', 'Veículo criado com sucesso!');
    }

    /**
     * Detalhes do veículo
     */
    public function show(string $id)
    {
        return view('veiculos.show', compact('id'));
    }

    /**
     * Formulário de edição
     */
    public function edit(string $id)
    {
        return view('veiculos.edit', compact('id'));
    }

    /**
     * Atualizar veículo
     */
    public function update(Request $request, string $id)
    {
        // Implementar lógica de atualização de veículo
        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Deletar veículo
     */
    public function destroy(string $id)
    {
        // Implementar lógica de exclusão de veículo
        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }
}