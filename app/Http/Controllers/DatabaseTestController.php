<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grupo;
use App\Models\Condominio;
use App\Models\Imovel;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseTestController extends Controller
{
    /**
     * Teste de banco de dados
     *
     * @OA\Get(
     *     path="/database-test",
     *     operationId="databaseTest",
     *     tags={"Sistema"},
     *     summary="Teste de conectividade com banco de dados",
     *     description="Retorna informações sobre a conexão com o banco de dados e contagem de registros",
     *     @OA\Response(
     *         response=200,
     *         description="Informações do banco de dados",
     *         @OA\JsonContent(
     *             @OA\Property(property="connection", type="string", example="PostgreSQL - Supabase"),
     *             @OA\Property(property="database", type="string"),
     *             @OA\Property(property="host", type="string"),
     *             @OA\Property(
     *                 property="counts",
     *                 type="object",
     *                 @OA\Property(property="usuarios", type="integer"),
     *                 @OA\Property(property="grupos", type="integer"),
     *                 @OA\Property(property="condominios", type="integer"),
     *                 @OA\Property(property="imoveis", type="integer"),
     *                 @OA\Property(property="veiculos", type="integer")
     *             )
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function index()
    {
        $stats = [
            'connection' => 'PostgreSQL - Supabase',
            'database' => config('database.connections.pgsql.database'),
            'host' => config('database.connections.pgsql.host'),
            'counts' => [
                'usuarios' => User::count(),
                'grupos' => Grupo::count(),
                'condominios' => Condominio::count(),
                'imoveis' => Imovel::count(),
                'veiculos' => Veiculo::count(),
            ]
        ];

        // Lista algumas tabelas do banco
        $tables = DB::select("
            SELECT tablename 
            FROM pg_tables 
            WHERE schemaname = 'public' 
            AND tablename NOT IN ('migrations', 'sessions')
            ORDER BY tablename
        ");

        return view('database-test', compact('stats', 'tables'));
    }
}
