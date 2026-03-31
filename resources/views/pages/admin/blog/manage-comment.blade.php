@extends('layouts.admin')

@section('content')

<div class="container mt-4 py-5">
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-tools"></i> Filtragem de Comentários </h1>
    </div>

    <div class="row g-4">
        @forelse($comments->where('status', 'pendente') as $comment)
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0" style="position: relative;">
                <a href="/blog/comment/{{ $comment->id }}" class="card-body" style="text-decoration: none;">
                    <div class="d-flex align-items-center mb-3">

                    </div>

                    <h6 class="fw-bold">
                        Post: {{ $comment->post->title}}
                    </h6>

                    <div class="comment-content small">
                        {!! $comment->content !!}
                    </div>

                    <small class="text-muted">{{ $comment->created_at->format('d/m/Y') }}</small>
                </a>

                <div class="d-flex gap-2 pb-4 px-3">
                    <form action="/admin/blog/{{ $comment->id }}/comment/reject" method="POST" style="display: inline;"
                        onsubmit="return confirm('Tem certeza que deseja rejeitar este comment?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-x"></i> Negar
                        </button>
                    </form>

                    <form action="/admin/blog/{{ $comment->id }}/comment/accept" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-check"></i> Aceitar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card text-center shadow-sm border-0 p-5">
                <i class="fas fa-comments fa-3x mb-3 text-muted"></i>
                <h5 class="text-muted">Nenhum comentário pendente</h5>
                <p class="text-muted mb-0">
                    Quando houver comentários para aprovação, eles aparecerão aqui.
                </p>
            </div>
        </div>
        @endforelse
    </div>

</div>

@endsection