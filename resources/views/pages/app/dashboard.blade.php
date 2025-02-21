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
                                <a href="#" class="btn btn-primary">Vote</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endcan
    @endrole
@endsection
