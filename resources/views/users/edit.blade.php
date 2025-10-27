@extends('layouts.admin')

@section('title', 'Editar Usuário - Condoflow Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account-edit"></i>
        </span>
        Editar Usuário
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informações do Usuário</h4>
                <p class="card-description">Edite as informações do usuário <strong>{{ $user->nome }}</strong></p>
                
                <form class="forms-sample" method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome Completo *</label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                                       id="nome" name="nome" value="{{ old('nome', $user->nome) }}" placeholder="Nome completo do usuário" required>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-mail *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="email@exemplo.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_pessoa">Tipo de Pessoa *</label>
                                <select class="form-control @error('tipo_pessoa') is-invalid @enderror" id="tipo_pessoa" name="tipo_pessoa" required>
                                    <option value="">Selecione...</option>
                                    <option value="FISICA" {{ old('tipo_pessoa', $user->tipo_pessoa) == 'FISICA' ? 'selected' : '' }}>Pessoa Física</option>
                                    <option value="JURIDICA" {{ old('tipo_pessoa', $user->tipo_pessoa) == 'JURIDICA' ? 'selected' : '' }}>Pessoa Jurídica</option>
                                </select>
                                @error('tipo_pessoa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_documento">Tipo de Documento *</label>
                                <select class="form-control @error('tipo_documento') is-invalid @enderror" id="tipo_documento" name="tipo_documento" required>
                                    <option value="">Selecione...</option>
                                    <option value="CPF" {{ old('tipo_documento', $user->tipo_documento) == 'CPF' ? 'selected' : '' }}>CPF</option>
                                    <option value="CNPJ" {{ old('tipo_documento', $user->tipo_documento) == 'CNPJ' ? 'selected' : '' }}>CNPJ</option>
                                    <option value="RG" {{ old('tipo_documento', $user->tipo_documento) == 'RG' ? 'selected' : '' }}>RG</option>
                                </select>
                                @error('tipo_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control @error('cpf') is-invalid @enderror" 
                                       id="cpf" name="cpf" value="{{ old('cpf', $user->cpf) }}" placeholder="000.000.000-00">
                                @error('cpf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control @error('telefone') is-invalid @enderror" 
                                       id="telefone" name="telefone" value="{{ old('telefone', $user->telefone) }}" placeholder="(11) 3333-4444">
                                @error('telefone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_nascimento">Data de Nascimento</label>
                                <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" 
                                       id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento', $user->data_nascimento?->format('Y-m-d')) }}">
                                @error('data_nascimento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ativo">Status do Usuário *</label>
                                <select class="form-control @error('ativo') is-invalid @enderror" id="ativo" name="ativo" required>
                                    <option value="1" {{ old('ativo', $user->ativo) == 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ old('ativo', $user->ativo) == 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                                @error('ativo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="card border-0" style="background: rgba(255, 255, 255, 0.05);">
                            <div class="card-header border-0" style="background: rgba(52, 144, 220, 0.1); border-bottom: 1px solid rgba(52, 144, 220, 0.2);">
                                <h6 class="card-title mb-0 text-info">
                                    <i class="mdi mdi-information-outline me-2"></i>
                                    Informações do Sistema
                                </h6>
                            </div>
                            <div class="card-body" style="background: transparent;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <small class="text-muted d-block">ID do Usuário</small>
                                            <span class="badge badge-outline-secondary">{{ $user->id }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block">Criado em</small>
                                            <span class="text-light">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <small class="text-muted d-block">Última atualização</small>
                                            <span class="text-light">{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block">Tipo de Pessoa</small>
                                            <span class="badge badge-outline-info">{{ $user->tipo_pessoa == 'FISICA' ? 'Pessoa Física' : 'Pessoa Jurídica' }}</span>
                                        </div>
                                        <div class="mb-0">
                                            <small class="text-muted d-block">Status Atual</small>
                                            @if($user->ativo)
                                                <span class="badge badge-outline-success">
                                                    <i class="mdi mdi-check-circle me-1"></i>Ativo
                                                </span>
                                            @else
                                                <span class="badge badge-outline-danger">
                                                    <i class="mdi mdi-close-circle me-1"></i>Inativo
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-gradient-primary me-2">
                            <i class="mdi mdi-content-save"></i>
                            Atualizar Usuário
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left"></i>
                            Cancelar
                        </a>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info">
                            <i class="mdi mdi-eye"></i>
                            Visualizar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
@endsection
