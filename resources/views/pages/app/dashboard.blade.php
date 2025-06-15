@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <style>
        .btn {
            width: 100%;
        }
    </style>
    <div class="col-md-12">
        @include('includes.alert')
    </div>

    @role('voter')
        @can('vote-create')
            <div class="row justify-content-center">
                <div class="col-12 mb-3">
                    <h1 class="text-center">Pilih Kandidat Terfavorit Kamu</h1>
                </div>

                <div class="row justify-content-center">
                    @foreach ($candidates as $candidate)
                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <div class="card h-100 shadow-sm d-flex flex-column">
                                <img src="{{ asset('storage/' . $candidate->image) }}" alt="{{ $candidate->name }}"
                                    class="card-img-top mb-3">
                                <div class="card-body d-flex flex-column flex-grow-1">
                                    <h5 class="card-title">{{ $candidate->name }}</h5>
                                    <p><strong>Visi:</strong> {{ $candidate->vision }}</p>
                                    <p><strong>Misi:</strong> {{ $candidate->mission }}</p>
                                    <div class="mt-auto">
                                        @if (Auth::user()->voter->vote)
                                            <button class="btn btn-secondary w-100" disabled>
                                                Already Voted
                                            </button>
                                        @else
                                            <a href="{{ route('app.vote', $candidate->id) }}" class="btn btn-primary w-100">
                                                Vote
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endcan
    @endrole

    @role('admin')
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <h2 class="text-center mb-3">Hasil Voting Realtime</h2>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div id="pie-results"></div>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@endsection

@section('scripts')
    @role('admin')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var candidates = @json($candidates->pluck('name'));
                var votes = @json($candidates->pluck('votes_count'));

                var options = {
                    chart: {
                        type: 'pie',
                        width: '100%',
                        height: '400px'
                    },
                    series: votes,
                    labels: candidates,
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                width: '100%'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#pie-results"), options);
                chart.render();
            });
        </script>

        <script>
            setTimeout(function() {
                location.reload();
            }, 5000);
        </script>
    @endrole
@endsection
