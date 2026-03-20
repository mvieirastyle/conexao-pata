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

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Listagem de Pedidos de Adoção</h5>
            </div>
        </div>

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
                            <th class="text-end">Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($formAdoptions as $request)
                        <tr>
                            <td>#{{ $request->id }}</td>
                            <td>{{ $request->full_name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->phone }}</td>
                            <td>{{ $request->animal?->nome ?? '---' }}</td>
                            <td>{{ $request->birth_date ? \Illuminate\Support\Carbon::parse($request->birth_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $request->created_at ? $request->created_at->format('d/m/Y H:i') : '-' }}</td>

                            </td>
                            <td class="text-end">
                                <a href="/admin/animal/adoption-requests/{{ $request->id }}" class="btn btn-sm btn-primary me-1"
                                    title="Informações"><i class="fa-solid fa-circle-info"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Nenhum pedido de adoção encontrado.</td>
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
@endsection