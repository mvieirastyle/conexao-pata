@extends('layouts.default')

@section('content')

<section class="d-flex align-items-center justify-content-center" style="min-height: 80vh; background-color: #f0f2f5;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 rounded-lg">

                    <div class="card-header bg-success text-white text-center py-4">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-envelope-open-text me-2"></i>Verificar Email
                        </h3>
                    </div>

                    <div class="card-body p-4 text-center">

                        @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif

                        <p class="mb-4">
                            Enviámos um link de verificação para o teu email<br>
                            Por favor verifica a tua caixa de entrada e clica no link para ativar a conta.
                        </p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success btn-lg text-white">
                                    <i class="fas fa-paper-plane me-2"></i>Reenviar Email
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

                <div class="card-footer text-center py-3 bg-light">
                    <p class="mb-0 small">
                        Não recebeste o email? Clica para reenviar.
                    </p>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

@endsection