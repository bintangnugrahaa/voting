@extends('layouts.app')

@section('title', 'Candidate')

@section('content')
    <div class="row">

        @can('candidate-create')
            <div class="col-md-12 mb-3">
                <a href="{{ route('app.candidate.create') }}" class="btn btn-primary">Add Candidate</a>
            </div>
        @endcan

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Candidates List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Chairman</th>
                                    <th>Vice Chairman</th>
                                    <th>Vision</th>
                                    <th>Mission</th>
                                    <th>Sort Order</th>
                                    <th>Voting Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($candidates as $candidate)
                                    <tr>
                                        <td>{{ $candidate->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $candidate->image) }}"
                                                alt="{{ $candidate->name }}" class="img-thumbnail"
                                                style="max-width: 100px;">
                                        </td>
                                        <td>{{ $candidate->chairman }}</td>
                                        <td>{{ $candidate->vice_chairman }}</td>
                                        <td>{{ $candidate->vision }}</td>
                                        <td>{{ $candidate->mission }}</td>
                                        <td>{{ $candidate->sort_order }}</td>
                                        <td>{{ $candidate->votes->count() }}</td>
                                        <td>
                                            @can('candidate-update')
                                                <a href="{{ route('app.candidate.edit', $candidate->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            @endcan

                                            <a href="{{ route('app.candidate.show', $candidate->id) }}"
                                                class="btn btn-info btn-sm">Show</a>

                                            @can('candidate-delete')
                                                <form action="{{ route('app.candidate.destroy', $candidate->id) }}"
                                                    method="POST" class="d-inline">
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
