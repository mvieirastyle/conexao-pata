@extends('layouts.default')

@section('content')

<section class="py-5 bg-green header-small" style="background-color: var(--green);">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white">Blog</h1>
        <p class="lead text-white">{{__('blog.index.text_blog')}}</p>
    </div>
</section>


<div class="container mt-4 py-5">

    @if (Auth::check())
    <div class="mb-4 text-end">
        <a href="/blog/new_post" class="btn btn-orange">
            <i class="fas fa-plus"></i> {{__('blog.index.create_post')}}
        </a>
    </div>
    @else
    <div class="alert alert-warning">
        {!! __('blog.index.alert_login') !!}
    </div>
    @endif

    <div class="d-flex gap-3 mb-3 text-muted small">
        <span>
            <x-heroicon-o-newspaper style="width:20px; height:20px;" />
            {{__('blog.index.all_posts')}}
        </span>
    </div>

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
                </div>

                <a href="/blog/post/{{ $post->id }}" class="stretched-link"></a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-3 align-items-end justify-content-end d-flex">
        {{ $posts->links() }}
    </div>
</div>

@endsection