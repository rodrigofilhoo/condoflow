<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibir dashboard principal
     *
     * @OA\Get(
     *     path="/dashboard",
     *     operationId="getDashboard",
     *     tags={"Dashboard"},
     *     summary="Dashboard principal",
     *     description="Exibe o painel principal da aplicação",
     *     @OA\Response(
     *         response=200,
     *         description="Dashboard renderizado com sucesso"
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Buscar recursos
     *
     * @OA\Get(
     *     path="/search",
     *     operationId="search",
     *     tags={"Dashboard"},
     *     summary="Buscar recursos",
     *     description="Realiza busca em usuários, imóveis, veículos e condomínios",
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         description="Termo de busca",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resultados da busca"
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        // Aqui você pode implementar a lógica de busca
        // Por exemplo, buscar produtos, usuários, etc.
        
        return view('search.results', compact('query'));
    }
}
