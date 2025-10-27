<?php

namespace App\Http\Controllers;

use App\Services\PrismaService;
use Illuminate\Http\Request;

class CondominioController extends Controller
{
    protected $prismaService;

    public function __construct(PrismaService $prismaService)
    {
        $this->prismaService = $prismaService;
    }

    /**
     * Display a listing of condominios.
     */
    public function index()
    {
        try {
            $condominios = $this->prismaService->getCondominios();
            
            return response()->json([
                'success' => true,
                'data' => $condominios
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar condomínios: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get imoveis by condominio ID.
     */
    public function imoveis($condominioId)
    {
        try {
            $imoveis = $this->prismaService->getImoveisByCondominio($condominioId);
            
            return response()->json([
                'success' => true,
                'data' => $imoveis
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar imóveis: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show database sync status.
     */
    public function syncStatus()
    {
        return response()->json([
            'success' => true,
            'message' => 'Prisma conectado ao Supabase',
            'database_url' => config('database.connections.pgsql.host'),
            'prisma_schema' => file_exists(base_path('prisma/schema.prisma'))
        ]);
    }
}
