@extends('layouts.admin')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fa-solid fa-chart-line"></i> {{ __('common.dashboard_area') }}</h1>
    </div>

    <div class="charts-wrapper row">
        <div class="col-md-12">
            <div class="chart-card">
                <form method="GET" class="filter-form">
                    <div>
                        <label>{{__('common.inicial_date')}}:</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}">
                    </div>

                    <div>
                        <label>{{__('common.final_date')}}:</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success btn-sm">
                            {{__('common.search')}}
                        </button>
                    </div>
                </form>

                {!! $chartAdocoes->container() !!}

                <div>
                    <a href="adocoes-excel" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> {{ __('common.export_excel') }}
                    </a>
                    <a href="adocoes-pdf" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> {{ __('common.export_pdf') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <div class="chart-card">
                {!! $chartMicrochips->container() !!}

                <div>
                    <a href="microchips-excel" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> {{ __('common.export_excel') }}
                    </a>
                    <a href="microchips-pdf" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> {{ __('common.export_pdf') }}
                    </a>
                </div>

            </div>

            <div class="chart-card mt-4" style="height: 870px;">
                {!! $chartAnimals->container() !!}

                <div>
                    <a href="animais-excel" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> {{ __('common.export_excel') }}
                    </a>
                    <a href="animais-pdf" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> {{ __('common.export_pdf') }}
                    </a>
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="chart-card mt-4">

                <form method="GET" class="filter-form">
                    <div>
                        <label>{{__('common.inicial_date')}}:</label>
                        <input type="date" name="inicialDate" value="{{ request('inicialDate') }}">
                    </div>

                    <div>
                        <label>{{__('common.final_date')}}:</label>
                        <input type="date" name="lastDate" value="{{ request('lastDate') }}">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success btn-sm">
                            {{__('common.search')}}
                        </button>
                    </div>
                </form>

                {!! $chartAdoptions->container() !!}

                <div>
                    <a href="adoptions-excel" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> {{ __('common.export_excel') }}
                    </a>
                    <a href="adoptions-pdf" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> {{ __('common.export_pdf') }}
                    </a>
                </div>

            </div>

            <div class="chart-card mt-4">

                <form method="GET" class="filter-form">
                    <div>
                        <label>{{__('common.inicial_date')}}:</label>
                        <input type="date" name="inicioData" value="{{ request('inicioData') }}">
                    </div>

                    <div>
                        <label>{{__('common.final_date')}}:</label>
                        <input type="date" name="fimData" value="{{ request('fimData') }}">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success btn-sm">
                            {{__('common.search')}}
                        </button>
                    </div>
                </form>

                {!! $chartEntradas->container() !!}

                <div>
                    <a href="entradas-excel" class="btn btn-sm">
                        <i class="fa-regular fa-file-excel"></i> {{ __('common.export_excel') }}
                    </a>
                    <a href="entradas-pdf" class="btn btn-sm">
                        <i class="fa-regular fa-file-pdf"></i> {{ __('common.export_pdf') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>


<script src="{{ $chartAnimals->cdn() }}"></script>
<script src="{{ $chartAdocoes->cdn() }}"></script>
<script src="{{ $chartEntradas->cdn() }}"></script>
<script src="{{ $chartMicrochips->cdn() }}"></script>
<script src="{{ $chartAdoptions->cdn() }}"></script>

{{ $chartAnimals->script() }}
{{ $chartAdocoes->script() }}
{{ $chartEntradas->script() }}
{{ $chartMicrochips->script() }}
{{ $chartAdoptions->script() }}

@endsection
