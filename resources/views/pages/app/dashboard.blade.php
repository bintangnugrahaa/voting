@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-12">
        @include('includes.alert')
    </div>

    @role('voter')
        @can('vote-create')
            <div class="row justify-content-center">
                <div class="col-12 mb-3">
                    <h1 class="text-center">Select your most preferred candidate</h1>
                </div>
                @foreach ($candidates as $candidate)
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $candidate->image) }}" alt="{{ $candidate->name }}"
                                    class="card-img-top mb-3">

                                <h5 class="card-title">
                                    {{ $candidate->name }} ({{ $candidate->chairman }} & {{ $candidate->vice_chairman }})
                                </h5>
                                <p><strong>Vision:</strong> {{ $candidate->vision }}</p>
                                <p><strong>Mission:</strong> {{ $candidate->mission }}</p>

                                @if (Auth::user()->voter->vote)
                                    <button class="btn btn-danger" disabled>
                                        Already Voted
                                    </button>
                                @else
                                    <a href="{{ route('app.vote', $candidate->id) }}" class="btn btn-primary">
                                        Vote
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endcan
    @endrole

    @role('admin')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-3">Hasil Voting Realtime</h2>
                <div class="card">
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
                        width: 500
                    },
                    series: votes,
                    labels: candidates
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
