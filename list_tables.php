<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Tabelas no banco PostgreSQL:\n";
$tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");
foreach($tables as $table) {
    echo "- " . $table->tablename . "\n";
}

echo "\nEstrutura das tabelas:\n";
foreach($tables as $table) {
    $tableName = $table->tablename;
    echo "\n=== Tabela: $tableName ===\n";
    
    $columns = DB::select("
        SELECT 
            column_name, 
            data_type, 
            character_maximum_length,
            is_nullable,
            column_default
        FROM information_schema.columns 
        WHERE table_name = '$tableName' 
        AND table_schema = 'public'
        ORDER BY ordinal_position
    ");
    
    foreach($columns as $column) {
        $nullable = $column->is_nullable === 'YES' ? 'NULL' : 'NOT NULL';
        $length = $column->character_maximum_length ? "($column->character_maximum_length)" : '';
        $default = $column->column_default ? " DEFAULT $column->column_default" : '';
        
        echo "  $column->column_name: $column->data_type$length $nullable$default\n";
    }
}
