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
