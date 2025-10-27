@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>🎉 Conexão com PostgreSQL - Supabase</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-success">
                        <strong>✅ Conexão estabelecida com sucesso!</strong>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações da Conexão</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Banco:</strong> {{ $stats['connection'] }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Database:</strong> {{ $stats['database'] }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Host:</strong> {{ $stats['host'] }}
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Registros por Tabela</h5>
                            <ul class="list-group list-group-flush">
                                @foreach($stats['counts'] as $table => $count)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ ucfirst($table) }}
                                    <span class="badge bg-primary rounded-pill">{{ $count }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Tabelas Disponíveis no Banco</h5>
                        <div class="row">
                            @foreach($tables as $table)
                            <div class="col-md-3 mb-2">
                                <span class="badge bg-secondary">{{ $table->tablename }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4 alert alert-info">
                        <h6>📋 Modelos Eloquent Criados:</h6>
                        <p>
                            <code>User</code>, <code>Grupo</code>, <code>Condominio</code>, 
                            <code>Bloco</code>, <code>Imovel</code>, <code>Veiculo</code>, 
                            <code>ContratoLocacao</code>, <code>Imobiliaria</code>, 
                            <code>Ocorrencia</code>, <code>Multa</code>, 
                            <code>VagaEstacionamento</code>, <code>RecursoCondominio</code>, 
                            <code>AgendamentoRecurso</code>, <code>PessoaImovel</code>
                        </p>
                        <small>Todos os modelos estão configurados com UUIDs, relacionamentos e cast adequados.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
