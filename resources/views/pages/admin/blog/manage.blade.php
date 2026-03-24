@extends('layouts.admin')

@section('content')

<div class="container mt-4 py-5">

    <div class="row g-4">
        @foreach($posts as $post)
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">

                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $post->user->fotos->first()?->path ? asset('storage/'. $post->user->fotos->first()?->path) : asset('/images/profilePicture.png') }}"
                            class="rounded-circle me-2" width="50" height="50" style="object-fit: cover;"
                            id="preview" />

                        <span class="fw-semibold">{{ '@' . $post->user->name }}</span>


                    </div>

                    <h6 class="fw-bold">
                        {{ $post->title }}
                    </h6>

                    <div class="post-content text-muted small">
                        {!! $post->description !!}
                    </div>

                    <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>

                    <div class="mt-3 d-flex gap-2">
                        <form action="/admin/blog/{{ $post->id }}/reject" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja rejeitar este post?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-x"></i> Negar
                            </button>
                        </form>

                        <form action="/admin/blog/{{ $post->id }}/accept" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-check"></i> Aceitar
                            </button>
                        </form>
                    </div>
                </div>

                <a href="/blog/post/{{ $post->id }}" class="stretched-link"></a>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection