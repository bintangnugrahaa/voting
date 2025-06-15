@extends('layouts.app')

@section('title', 'Voter Management')

@section('content')
    <div class="row">

        @can('voter-create')
            <div class="col-md-12 mb-3">
                <a href="{{ route('app.voter.create') }}" class="btn btn-primary">Add Voter</a>
            </div>
        @endcan

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Voter List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voters as $voter)
                                    <tr>
                                        <td>{{ $voter->name }}</td>
                                        <td>{{ $voter->user->email }}</td>
                                        <td>
                                            @if ($voter->vote)
                                                <span class="badge bg-success text-white p-2">
                                                    Already Voted
                                                </span>
                                            @else
                                                <span class="badge bg-danger text-white p-2">
                                                    Not Voted
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('voter-update')
                                                <a href="{{ route('app.voter.edit', $voter->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            @endcan

                                            <a href="{{ route('app.voter.show', $voter->id) }}"
                                                class="btn btn-info btn-sm">Show</a>

                                            @can('voter-delete')
                                                <form action="{{ route('app.voter.destroy', $voter->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "Search:",
                    lengthMenu: "Display _MENU_ records per page",
                    info: "Showing page _PAGE_ of _PAGES_",
                    infoEmpty: "No records available",
                    infoFiltered: "(filtered from _MAX_ total records)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });
    </script>
@endsection
