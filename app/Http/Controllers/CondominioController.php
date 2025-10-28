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
     * Listar todos os condomínios
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
     * Obter imóveis de um condomínio
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
     * Verificar status de sincronização
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
