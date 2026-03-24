@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-tools"></i> {{__('common.administration_panel')}}</h1>
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

    <form method="GET" class="mb-1 align-items-start" action="/admin/animal/adoption-requests">

        <input type="hidden" name="tab" value="{{ $activeTab }}">

        <h5 class="mb-2 text-start">
            {{ __('front_end.gallery.search') }}
        </h5>

        <div class="filter-form bg-dark text-white p-3 rounded d-flex gap-3 flex-nowrap">

            <div class="input-group">
                <div class="input-group-text">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ request('email') }}">
            </div>

            <div class="input-group">
                <div class="input-group-text">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <input type="text" class="form-control" placeholder="Telefone / Telemovel" name="phone"
                    value="{{ request('phone') }}">
            </div>

            <a href="{{ url()->current() }}" class="btn btn-outline-light">
                <i class="fa-solid fa-x"></i>
            </a>

            <button type="submit" class="btn btn-outline-light">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

        </div>
    </form>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'pendentes' ? 'active' : '' }}" id="home-tab" data-bs-toggle="tab"
                data-bs-target="#home-tab-pane" type="button">
                Pendentes
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'aceitos' ? 'active' : '' }}" id="accept-tab" data-bs-toggle="tab"
                data-bs-target="#accept-tab-pane" type="button">
                Aprovadas
            </button>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{ $activeTab === 'pendentes' ? 'show active' : '' }}" id="home-tab-pane">
            <div class="card-header bg-dark text-white py-2 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Pedidos Pendentes de Adoção</h5>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome do Candidato</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Animal</th>
                                    <th>Data Nascimento</th>
                                    <th>Criado em</th>
                                    <th>Estado</th>
                                    <th class="text-end">Informações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($formAdoptions->filter(fn($item) => $item->accept == 0) as $request)
                                <tr>
                                    <td>#{{ $request->id }}</td>
                                    <td>{{ $request->full_name }}</td>
                                    <td>{{ $request->email }}</td>
                                    <td>{{ $request->phone }}</td>
                                    <td><a href="/admin/animal/edit/{{ $request->animal_id }}">{{
                                            $request->animal?->nome ?? '---' }}</a></td>
                                    <td>{{ $request->birth_date ?
                                        \Illuminate\Support\Carbon::parse($request->birth_date)->format('d/m/Y') : '-'
                                        }}</td>
                                    <td>{{ $request->created_at ? $request->created_at->format('d/m/Y') : '-' }}</td>
                                    <td> @if ($request->accept)
                                        <span class="badge bg-success">Aceito</span>
                                        @else
                                        <span class="badge bg-secondary">Esperando</span>
                                        @endif
                                    </td>

                                    </td>
                                    <td class="text-end">
                                        <a href="/admin/animal/adoption-requests/{{ $request->id }}"
                                            class="btn btn-sm btn-primary me-1" title="Informações"><i
                                                class="fa-solid fa-circle-info"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">Nenhum pedido de adoção encontrado.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3 align-items-end justify-content-end d-flex">
                {{ $formAdoptions->links() }}
            </div>
        </div>
    </div>
    <div class="tab-pane fade {{ $activeTab === 'aceitos' ? 'show active' : '' }}" id="accept-tab-pane">
        <div class="card-header bg-dark text-white py-2 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Pedidos Aceitos de Adoção</h5>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome do Candidato</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Animal</th>
                                <th>Data Nascimento</th>
                                <th>Criado em</th>
                                <th>Estado</th>
                                <th class="text-end">Informações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($formAdoptions->filter(fn($item) => $item->accept == 1) as $request)
                            <tr>
                                <td>#{{ $request->id }}</td>
                                <td>{{ $request->full_name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->phone }}</td>
                                <td><a href="/admin/animal/edit/{{ $request->animal_id }}">{{ $request->animal?->nome ??
                                        '---' }}</a></td>
                                <td>{{ $request->birth_date ?
                                    \Illuminate\Support\Carbon::parse($request->birth_date)->format('d/m/Y') : '-' }}
                                </td>
                                <td>{{ $request->created_at ? $request->created_at->format('d/m/Y') : '-' }}</td>
                                <td> @if ($request->accept === 1)
                                    <span class="badge bg-success">Aceito</span>
                                    @else
                                    <span class="badge bg-secondary">Esperando</span>
                                    @endif
                                </td>

                                </td>
                                <td class="text-end">
                                    <a href="/admin/animal/adoption-requests/{{ $request->id }}"
                                        class="btn btn-sm btn-primary me-1" title="Informações"><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">Nenhum pedido de adoção encontrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3 align-items-end justify-content-end d-flex">
            {{ $formAdoptions->links() }}
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabInput = document.querySelector('input[name="tab"]');
        const tabButtons = document.querySelectorAll('#myTab button[data-bs-toggle="tab"]');

        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', event => {
                const tabKey = event.target.id === 'accept-tab' ? 'aceitos' : 'pendentes';

                if (tabInput) {
                    tabInput.value = tabKey;
                }

                const url = new URL(window.location);
                url.searchParams.set('tab', tabKey);
                window.history.replaceState({}, '', url);
            });
        });

        const url = new URL(window.location);
        if (!url.searchParams.has('tab') && tabInput && tabInput.value) {
            url.searchParams.set('tab', tabInput.value);
            window.history.replaceState({}, '', url);
        }
    });
</script>

@endsection