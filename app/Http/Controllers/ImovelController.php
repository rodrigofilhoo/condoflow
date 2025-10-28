<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImovelController extends Controller
{
    /**
     * Listar imóveis
     */
    public function index()
    {
        return view('imoveis.index');
    }

    /**
     * Formulário de novo imóvel
     */
    public function create()
    {
        return view('imoveis.create');
    }

    /**
     * Criar imóvel
     */
    public function store(Request $request)
    {
        // Implementar lógica de criação de imóvel
        return redirect()->route('imoveis.index')->with('success', 'Imóvel criado com sucesso!');
    }

    /**
     * Detalhes do imóvel
     */
    public function show(string $id)
    {
        return view('imoveis.show', compact('id'));
    }

    /**
     * Formulário de edição
     */
    public function edit(string $id)
    {
        return view('imoveis.edit', compact('id'));
    }

    /**
     * Atualizar imóvel
     */
    public function update(Request $request, string $id)
    {
        // Implementar lógica de atualização de imóvel
        return redirect()->route('imoveis.index')->with('success', 'Imóvel atualizado com sucesso!');
    }

    /**
     * Deletar imóvel
     */
    public function destroy(string $id)
    {
        // Implementar lógica de exclusão de imóvel
        return redirect()->route('imoveis.index')->with('success', 'Imóvel excluído com sucesso!');
    }
}