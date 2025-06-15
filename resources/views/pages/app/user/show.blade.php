@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('app.user.index') }}" class="btn btn-danger">Back</a>
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $user->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Permissions</th>
                                    <td>{{ $user->roles->first()->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
