@extends('layouts.admin')

@section('title', 'Novo Imóvel - Condoflow Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Cadastrar Novo Imóvel
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('imoveis.index') }}">Imóveis</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo</li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informações do Imóvel</h4>
                <form class="forms-sample" method="POST" action="{{ route('imoveis.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numero">Número/Unidade</label>
                                <input type="text" class="form-control" id="numero" name="numero" placeholder="101, 202A, etc." required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bloco">Bloco/Torre</label>
                                <input type="text" class="form-control" id="bloco" name="bloco" placeholder="A, B, Torre 1, etc.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="andar">Andar</label>
                                <input type="number" class="form-control" id="andar" name="andar" placeholder="1, 2, 3..." min="0">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo">Tipo de Imóvel</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="">Selecione...</option>
                                    <option value="apartamento">Apartamento</option>
                                    <option value="casa">Casa</option>
                                    <option value="cobertura">Cobertura</option>
                                    <option value="loja">Loja</option>
                                    <option value="sala">Sala Comercial</option>
                                    <option value="garagem">Garagem</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area">Área (m²)</label>
                                <input type="number" class="form-control" id="area" name="area" placeholder="50.5" step="0.01" min="0">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proprietario">Proprietário</label>
                                <input type="text" class="form-control" id="proprietario" name="proprietario" placeholder="Nome do proprietário" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inquilino">Inquilino</label>
                                <input type="text" class="form-control" id="inquilino" name="inquilino" placeholder="Nome do inquilino (se houver)">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="ocupado">Ocupado</option>
                                    <option value="vazio">Vazio</option>
                                    <option value="alugado">Alugado</option>
                                    <option value="vendido">Vendido</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quartos">Quartos</label>
                                <input type="number" class="form-control" id="quartos" name="quartos" min="0" max="10">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="observacoes">Observações</label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Observações adicionais..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary me-2">Salvar</button>
                    <a href="{{ route('imoveis.index') }}" class="btn btn-light">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection