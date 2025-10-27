<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Condoflow') }} - Verificação de Código</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login-background.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-start mb-3">Verificação de Segurança</h3>
                            
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('2fa.verify') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="two_factor_code">Código de verificação *</label>
                                    <input id="two_factor_code" type="text" class="form-control p_input @error('two_factor_code') is-invalid @enderror" name="two_factor_code" required autofocus>
                                    <small class="form-text text-muted">
                                        O código de verificação foi enviado para o seu e-mail.
                                    </small>
                                    
                                    @error('two_factor_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="text-center d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">
                                        <i class="mdi mdi-lock-open me-2"></i>{{ __('Verificar e Entrar') }}
                                    </button>
                                </div>
                                
                                <div class="mt-3 text-center">
                                    <a href="{{ route('2fa.resend') }}" class="text-info">
                                        <i class="mdi mdi-refresh me-1"></i>{{ __('Não recebeu o código? Clique aqui para reenviar') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
</body>
</html>
