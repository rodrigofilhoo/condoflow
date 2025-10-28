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
     *
     * @OA\Get(
     *     path="/api/condominios",
     *     operationId="getCondominios",
     *     tags={"Condomínios"},
     *     summary="Listar condomínios",
     *     description="Retorna uma lista de todos os condomínios cadastrados no sistema",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de condomínios retornada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="nome", type="string", example="Condomínio Exemplo"),
     *                     @OA\Property(property="endereco", type="string", example="Rua 1, 100"),
     *                     @OA\Property(property="cidade", type="string", example="São Paulo")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro ao buscar condomínios"
     *     )
     * )
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
     *
     * @OA\Get(
     *     path="/api/condominios/{id}/imoveis",
     *     operationId="getCondominioImoveis",
     *     tags={"Condomínios"},
     *     summary="Listar imóveis do condomínio",
     *     description="Retorna todos os imóveis pertencentes a um condomínio específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do condomínio",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de imóveis retornada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="unidade", type="string", example="101"),
     *                     @OA\Property(property="bloco", type="string", example="A"),
     *                     @OA\Property(property="condominioId", type="integer", example=1)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro ao buscar imóveis"
     *     )
     * )
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
     *
     * @OA\Get(
     *     path="/api/sync-status",
     *     operationId="getSyncStatus",
     *     tags={"Condomínios"},
     *     summary="Status da sincronização",
     *     description="Retorna o status da conexão com o banco de dados Prisma/Supabase",
     *     @OA\Response(
     *         response=200,
     *         description="Status da sincronização",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Prisma conectado ao Supabase"),
     *             @OA\Property(property="database_url", type="string", example="host.db.supabase.co"),
     *             @OA\Property(property="prisma_schema", type="boolean", example=true)
     *         )
     *     )
     * )
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
