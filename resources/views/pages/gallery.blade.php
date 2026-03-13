@extends('layouts.default')

@section('content')
<section class="py-5 bg-light">
    <div class="container text-center">
        <h1 class="display-4 text-success"> {{__('front_end.gallery.title')}}</h1></br>
        <p class="lead"> {{__('front_end.gallery.subtitle')}}</p>
    </div>
</section>


<form method="GET" action="/gallery">

    <div class="container">

        <div class="alert alert-success border-0 shadow-sm" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            {{__('front_end.gallery.text_info_one')}}</p>
            <p>{!!__('front_end.gallery.text_info_two')!!}</p>
            <p>{!!__('front_end.gallery.text_info_three')!!}</p>
        </div>

        <section class="section-padding">

            <div class="row mb-5">
                <div class="col-12">
                    <h5 class="mb-3 text-start" style="color: #1e8449; font-weight: 800; padding-left: 20px;">
                        {{__('front_end.gallery.search')}}</h5>

                    <div class="search-filter-bar d-flex flex-wrap align-items-center gap-3">
                        <select class="form-select search-filter-select" name="animal">
                            <option value="" disabled {{ request('animal')===null ? 'selected' : '' }}>
                                {{__('front_end.animals')}}</option>
                            <option value="1" {{ request('animal')==1 ? 'selected' : '' }}>
                                {{__('front_end.gallery.dog')}}</option>
                            <option value="2" {{ request('animal')==2 ? 'selected' : '' }}>
                                {{__('front_end.gallery.cat')}}</option>
                            <option value="3" {{ request('animal')==3 ? 'selected' : '' }}>
                                {{__('front_end.gallery.another')}}</option>
                        </select>

                        <select class="form-select search-filter-select" name="sex">
                            <option value="" disabled {{ request('sex')===null ? 'selected' : '' }}>
                                {{__('front_end.gallery.sex')}}</option>
                            <option value="Macho" {{ request('sex')=='Macho' ? 'selected' : '' }}>
                                {{__('front_end.gallery.male')}}</option>
                            <option value="Fêmea" {{ request('sex')=='Fêmea' ? 'selected' : '' }}>
                                {{__('front_end.gallery.female')}}</option>
                        </select>

                        <select class="form-select search-filter-select" name="age">
                            <option value="" disabled {{ request('age')===null ? 'selected' : '' }}>
                                {{__('front_end.gallery.age')}}</option>
                            <option value="Filhote" {{ request('age')=='Filhote' ? 'selected' : '' }}>
                                {{__('front_end.gallery.young_animal')}}</option>
                            <option value="Adulto" {{ request('age')=='Adulto' ? 'selected' : '' }}>
                                {{__('front_end.gallery.adult')}}</option>
                            <option value="Idoso" {{ request('age')=='Idoso' ? 'selected' : '' }}>
                                {{__('front_end.gallery.old')}}</option>
                        </select>

                        <select class="form-select search-filter-select" name="size">
                            <option value="" disabled {{ request('size')===null ? 'selected' : '' }}>
                                {{__('front_end.gallery.size')}}</option>
                            <option value="pequeno" {{ request('size')=='pequeno' ? 'selected' : '' }}>
                                {{__('front_end.gallery.small')}}</option>
                            <option value="medio" {{ request('size')=='medio' ? 'selected' : '' }}>
                                {{__('front_end.gallery.medium')}}</option>
                            <option value="grande" {{ request('size')=='grande' ? 'selected' : '' }}>
                                {{__('front_end.gallery.large')}}</option>
                        </select>

                        <a href="{{ url()->current() }}">
                            <button type="button" class="btn search-filter-btn fw-bold"
                                style="background-color: #f0f0f0">
                                <i class="fa-solid fa-x" style="color: #757575;"></i>
                            </button>
                        </a>

                        <button class="btn search-filter-btn fw-bold" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </div>
</form>

<div class="row g-4">
    @forelse($animals as $animal)
    <div class="col-md-6 col-lg-4 animal-card">
        <div class="card card-custom h-100">
            <a href="/animal/{{ $animal->id }}" class="text-decoration-none text-dark">
                <img src="{{Storage::url($animal->fotos->first()?->path)}}" class="card-img-top"
                    alt="{{ $animal->nome}}" style="height: 250px; object-fit: cover;">
            </a>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <a href="/animal/{{ $animal->id}}" class="text-decoration-none text-dark">
                        <h5 class="card-title mb-0 hover-green">{{ $animal->nome}} </h5>
                    </a>
                    <span class="badge bg-success">{{ $animal->category->type}}</span>
                </div>
                <p class="card-text text-muted">
                    • {{ $animal->idade}}
                    • {{ $animal->sexo}}
                    • {{ $animal->porte }}
                </p>
                <p class="card-text text-truncate">{{ $animal->storytelling}}</p>
            </div>
            <div class="card-footer bg-transparent border-top-0 pb-3">
                <a href="/animal/{{ $animal->id}}"
                    class="btn btn-outline-success w-100">{{__('front_end.gallery.see_details')}}</a>
            </div>
        </div>
    </div>
    @empty
    <label class="text-center py-4">
        {{__('animal.not_found')}}
    </label>
    @endforelse
</div>
<div class="mt-3 align-items-end justify-content-end d-flex">
    {{ $animals->links() }}
</div>
</section>
@endsection