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
        <h1><i class="fas fa-tools"></i> {{ __('blog.manage_posts.title') }}</h1>
    </div>

    <div class="row g-4">
        @forelse($posts as $post)
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0" style="position: relative;">
                <a href="/blog/post/{{ $post->id }}" class="card-body" style="text-decoration: none;">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $post->user->fotos->first()?->path ? asset('storage/'. $post->user->fotos->first()?->path) : asset('/images/profilePicture.png') }}"
                            class="rounded-circle me-2" width="50" height="50" style="object-fit: cover;"
                            id="preview" alt="User Picture" />
                        <span class="fw-semibold">{{ '@' . $post->user->name }}</span>
                    </div>

                    <h6 class="fw-bold">
                        {{ $post->title }}
                    </h6>

                    <div class="post-content text-muted small">
                        {!! $post->description !!}
                    </div>

                    <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
                </a>

                <div class="d-flex gap-2 pb-4 px-3">
                    <form action="/admin/blog/{{ $post->id }}/post/reject" method="POST" style="display: inline;"
                        onsubmit="return confirm('{{ __('blog.manage_posts.confirm_reject') }}');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-x"></i> {{ __('blog.manage_posts.reject') }}
                        </button>
                    </form>

                    <form action="/admin/blog/{{ $post->id }}/post/accept" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-check"></i> {{ __('blog.manage_posts.accept') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card text-center shadow-sm border-0 p-5">
                <i class="fas fa-newspaper fa-3x mb-3 text-muted"></i>
                <h5 class="text-muted">{{ __('blog.manage_posts.empty_title') }}</h5>
                <p class="text-muted mb-0">
                    {{ __('blog.manage_posts.empty_text') }}
                </p>
            </div>
        </div>
        @endforelse
    </div>

</div>

@endsection
