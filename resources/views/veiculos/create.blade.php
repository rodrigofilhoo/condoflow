@extends('layouts.admin')

@section('title', 'Novo Veículo - Condoflow Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-car"></i>
        </span>
        Cadastrar Novo Veículo
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('veiculos.index') }}">Veículos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo</li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informações do Veículo</h4>
                <form class="forms-sample" method="POST" action="{{ route('veiculos.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="placa">Placa</label>
                                <input type="text" class="form-control" id="placa" name="placa" placeholder="ABC-1234" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca" placeholder="Toyota, Honda, etc." required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modelo">Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Corolla, Civic, etc." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cor">Cor</label>
                                <input type="text" class="form-control" id="cor" name="cor" placeholder="Branco, Preto, etc." required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ano">Ano</label>
                                <input type="number" class="form-control" id="ano" name="ano" min="1900" max="2025" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proprietario">Proprietário</label>
                                <input type="text" class="form-control" id="proprietario" name="proprietario" placeholder="Nome do proprietário" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="observacoes">Observações</label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Observações adicionais..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary me-2">Salvar</button>
                    <a href="{{ route('veiculos.index') }}" class="btn btn-light">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection