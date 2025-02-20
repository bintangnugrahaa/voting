@extends('layouts.app')

@section('title', 'Voter Show')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Show Voter</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $voter->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $voter->user->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-end">
                            <a href="{{ route('app.voter.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
