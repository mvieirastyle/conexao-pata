@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-tools"></i> {{__('common.administration_panel')}}</h1>
        <a href="/admin/animal/add" class="btn btn-success"><i class="fas fa-plus"></i> {{__('animal.add_animal')}}</a>
    </div>

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

    <form method="GET" class="mb-1 align-items-start" action="/admin/animal/list">
        <h5 class="mb-2 text-start" style="color: #333333; font-weight: 500; padding-left: 5px;">
            {{__('front_end.gallery.search')}}</h5>
        <div class="filter-form bg-dark text-white p-3 rounded d-flex gap-3 flex-nowrap">
            <select class="form-select bg-light text-dark" name="animal">
                <option value="" disabled {{ request('animal')===null ? 'selected' : '' }}>{{__('front_end.animals')}}
                </option>
                <option value="1" {{ request('animal')==1 ? 'selected' : '' }}>{{__('front_end.gallery.dog')}}</option>
                <option value="2" {{ request('animal')==2 ? 'selected' : '' }}>{{__('front_end.gallery.cat')}}</option>
                <option value="3" {{ request('animal')==3 ? 'selected' : '' }}>{{__('front_end.gallery.another')}}
                </option>
            </select>

            <select class="form-select bg-light text-dark" name="sex">
                <option value="" disabled {{ request('sex')===null ? 'selected' : '' }}>{{__('front_end.gallery.sex')}}
                </option>
                <option value="Macho" {{ request('sex')=='Macho' ? 'selected' : '' }}>{{__('front_end.gallery.male')}}
                </option>
                <option value="Fêmea" {{ request('sex')=='Fêmea' ? 'selected' : '' }}>{{__('front_end.gallery.female')}}
                </option>
            </select>

            <select class="form-select bg-light text-dark" name="age">
                <option value="" disabled {{ request('age')===null ? 'selected' : '' }}>{{__('front_end.gallery.age')}}
                </option>
                <option value="Filhote" {{ request('age')=='Filhote' ? 'selected' : '' }}>
                    {{__('front_end.gallery.young_animal')}}</option>
                <option value="Adulto" {{ request('age')=='Adulto' ? 'selected' : '' }}>
                    {{__('front_end.gallery.adult')}}</option>
                <option value="Idoso" {{ request('age')=='Idoso' ? 'selected' : '' }}>{{__('front_end.gallery.old')}}
                </option>
            </select>

            <select class="form-select bg-light text-dark" name="size">
                <option value="" disabled {{ request('size')===null ? 'selected' : '' }}>
                    {{__('front_end.gallery.size')}}</option>
                <option value="pequeno" {{ request('size')=='pequeno' ? 'selected' : '' }}>
                    {{__('front_end.gallery.small')}}</option>
                <option value="medio" {{ request('size')=='medio' ? 'selected' : '' }}>
                    {{__('front_end.gallery.medium')}}</option>
                <option value="grande" {{ request('size')=='grande' ? 'selected' : '' }}>
                    {{__('front_end.gallery.large')}}</option>
            </select>

            <select class="form-select bg-light text-dark" name="disponivel">
                <option value="" disabled {{ request('disponivel')===null ? 'selected' : '' }}>
                    {{__('front_end.gallery.availability')}}
                </option>

                <option value="1" {{ request('disponivel')=='1' ? 'selected' : '' }}>
                    {{__('front_end.gallery.available')}}
                </option>

                <option value="0" {{ request('disponivel')=='0' ? 'selected' : '' }}>
                    {{__('front_end.gallery.unavailable')}}
                </option>
            </select>

            <a href="{{ url()->current() }}" class="btn btn-outline-light">
                <i class="fa-solid fa-x"></i>
            </a>

            <button type="submit" class="btn btn-outline-light">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

        </div>
    </form>

    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <div class="align-items-start">
                <h5 class="mb-0">{{__('animal.registered_animals')}}</h5>
            </div>
            <div class="text-end">
                <a href="list/export" class="btn text-white">
                    <i class="fa-regular fa-file-excel"></i> Export Excel
                </a>
                <a href="list/animais-pdf" class="btn text-white">
                    <i class="fa-regular fa-file-pdf"></i> Export PDF
                </a>
            </div>

        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>{{__('animal.columns.picture')}}</th>
                            <th>{{__('animal.columns.name')}}</th>
                            <th>{{__('animal.columns.category')}}</th>
                            <th>{{__('animal.columns.sex')}}</th>
                            <th>{{__('animal.columns.state')}}</th>
                            <th class="text-end">{{__('animal.columns.actions')}}</th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($animals as $animal)
                        <tr>
                            <td>#{{ $animal->id }}</td>
                            <td>
                                @if ($animal->fotos->isNotEmpty())
                                <img src="{{Storage::url($animal->fotos->first()?->path)}}" alt="{{ $animal->nome }}"
                                    class="rounded" style="width:90px; height:90px; object-fit: cover;">
                                @else
                                <span class="text-muted small">{{__('animal.lines.no_image')}}</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $animal->nome }}</td>
                            <td>{{ $animal->category ? $animal->category->type : 'N/A' }}</td>
                            <td>{{ $animal->sexo }}</td>
                            <td>
                                @if ($animal->disponivel)
                                <span class="badge bg-success">{{__('animal.lines.avaliable')}}</span>
                                @else
                                <span class="badge bg-secondary">{{__('animal.lines.unavailable')}}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="/admin/animal/edit/{{$animal->id}}" class="btn btn-sm btn-primary me-1"
                                    title="Editar"><i class="fas fa-edit"></i></a>

                                <form action="/admin/animal/delete/{{$animal->id}}" method="POST" class="d-inline"
                                    onsubmit="return confirm('{{__('animal.confirmed')}}');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">{{__('animal.not_found')}}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3 align-items-end justify-content-end d-flex">
        {{ $animals->links() }}
    </div>
</div>
@endsection