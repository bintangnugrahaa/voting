@extends('layouts.app')

@section('title', $candidate->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $candidate->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $candidate->name }}</td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <img src="{{ asset('storage/' . $candidate->image) }}" alt="{{ $candidate->name }}"
                                            class="img-thumbnail" width="100">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Chairman</th>
                                    <td>{{ $candidate->chairman }}</td>
                                </tr>
                                <tr>
                                    <th>Vice Chairman</th>
                                    <td>{{ $candidate->vice_chairman }}</td>
                                </tr>
                                <tr>
                                    <th>Vision</th>
                                    <td>{{ $candidate->vision }}</td>
                                </tr>
                                <tr>
                                    <th>Mission</th>
                                    <td>{{ $candidate->mission }}</td>
                                </tr>
                                <tr>
                                    <th>Sort Order</th>
                                    <td>{{ $candidate->sort_order }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-end">
                            <a href="{{ route('app.candidate.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
