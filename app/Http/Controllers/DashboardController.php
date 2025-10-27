<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Handle search functionality.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        // Aqui você pode implementar a lógica de busca
        // Por exemplo, buscar produtos, usuários, etc.
        
        return view('search.results', compact('query'));
    }
}
