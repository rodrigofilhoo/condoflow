@extends('layouts.admin')

@section('title', 'Visualizar Usuário - Condoflow Admin')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account-box"></i>
        </span>
        Detalhes do Usuário
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Informações do Usuário</h4>
                    <div>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-gradient-warning btn-rounded">
                            <i class="mdi mdi-pencil"></i>
                            Editar
                        </a>
                        <button type="button" class="btn btn-gradient-danger btn-rounded" onclick="deleteUser({{ $user->id }})">
                            <i class="mdi mdi-delete"></i>
                            Excluir
                        </button>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-card">
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/images/faces/face' . (abs(crc32($user->id)) % 15 + 1) . '.jpg') }}" 
                                     alt="Avatar" class="rounded-circle" width="100" height="100">
                                <h5 class="mt-3">{{ $user->nome }}</h5>
                                <p class="text-muted">{{ $user->email }}</p>
                                @if($user->ativo)
                                    <span class="badge badge-success">Ativo</span>
                                @else
                                    <span class="badge badge-danger">Inativo</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Informações Detalhadas</h6>
                                
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>ID:</strong></td>
                                            <td>{{ Str::limit($user->id, 8) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nome:</strong></td>
                                            <td>{{ $user->nome }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>E-mail:</strong></td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tipo de Pessoa:</strong></td>
                                            <td>{{ $user->tipo_pessoa == 'FISICA' ? 'Pessoa Física' : 'Pessoa Jurídica' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tipo Documento:</strong></td>
                                            <td>{{ $user->tipo_documento }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>CPF:</strong></td>
                                            <td>{{ $user->cpf ?: 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Telefone:</strong></td>
                                            <td>{{ $user->telefone ?: 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Data Nascimento:</strong></td>
                                            <td>{{ $user->data_nascimento ? $user->data_nascimento->format('d/m/Y') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($user->ativo)
                                                    <span class="text-success">Ativo</span>
                                                @else
                                                    <span class="text-danger">Inativo</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Criado em:</strong></td>
                                            <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Última atualização:</strong></td>
                                            <td>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Estatísticas do Usuário</h6>
                                
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="card bg-gradient-danger card-img-holder text-white">
                                            <div class="card-body">
                                                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                                                <h4 class="font-weight-normal mb-3">Dias ativo
                                                    <i class="mdi mdi-calendar-today mdi-24px float-right"></i>
                                                </h4>
                                                <h2 class="mb-5">{{ $user->created_at ? $user->created_at->diffInDays(now()) : 0 }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="card bg-gradient-info card-img-holder text-white">
                                            <div class="card-body">
                                                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                                                <h4 class="font-weight-normal mb-3">Status
                                                    <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                                </h4>
                                                <h2 class="mb-5">
                                                    @if($user->ativo)
                                                        Ativo
                                                    @else
                                                        Inativo
                                                    @endif
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="card bg-gradient-success card-img-holder text-white">
                                            <div class="card-body">
                                                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                                                <h4 class="font-weight-normal mb-3">Último acesso
                                                    <i class="mdi mdi-diamond mdi-24px float-right"></i>
                                                </h4>
                                                <h2 class="mb-5">{{ $user->updated_at ? $user->updated_at->diffForHumans() : 'N/A' }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="card bg-gradient-warning card-img-holder text-white">
                                            <div class="card-body">
                                                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                                                <h4 class="font-weight-normal mb-3">Perfil
                                                    <i class="mdi mdi-account-circle mdi-24px float-right"></i>
                                                </h4>
                                                <h2 class="mb-5">Usuário</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-light">
                        <i class="mdi mdi-arrow-left"></i>
                        Voltar à Lista
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-gradient-warning">
                        <i class="mdi mdi-pencil"></i>
                        Editar Usuário
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação para exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir o usuário <strong>{{ $user->nome }}</strong>? Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function deleteUser(userId) {
    const form = document.getElementById('deleteForm');
    form.action = `/users/${userId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endpush
@endsection
