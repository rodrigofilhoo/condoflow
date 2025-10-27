@extends('layouts.admin')

@section('title', 'Imóveis - Condoflow Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Gerenciar Imóveis
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Imóveis</li>
        </ul>
    </nav>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Lista de Imóveis</h4>
                    <a href="{{ route('imoveis.create') }}" class="btn btn-gradient-primary btn-rounded btn-fw">
                        <i class="mdi mdi-plus-circle-outline"></i>
                        Novo Imóvel
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Unidade</th>
                                <th>Bloco</th>
                                <th>Tipo</th>
                                <th>Proprietário</th>
                                <th>Inquilino</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="empty-state py-4">
                                        <i class="mdi mdi-home-variant text-muted" style="font-size: 48px;"></i>
                                        <h5 class="mt-3">Nenhum imóvel cadastrado</h5>
                                        <p class="mt-3">Comece cadastrando o primeiro imóvel do condomínio</p>
                                        <a href="{{ route('imoveis.create') }}" class="btn btn-primary">Cadastrar Imóvel</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection