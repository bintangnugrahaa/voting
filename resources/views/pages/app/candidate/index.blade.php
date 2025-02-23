@extends('layouts.app')

@section('title', 'Candidate')

@section('content')
    <div class="row">
        @can('candidate-create')
            <div class="col-md-12">
                <a href="{{ route('app.candidate.create') }}" class="btn btn-primary mb-3">Add Candidate</a>
            </div>
        @endcan

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Candidate</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
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
                                        <td><img src="{{ asset('storage/' . $candidate->image) }}"
                                                alt="{{ $candidate->name }}" class="img-thumbnail" width="100"></td>
                                        <td>{{ $candidate->chairman }}</td>
                                        <td>{{ $candidate->vice_chairman }}</td>
                                        <td>{{ $candidate->vision }}</td>
                                        <td>{{ $candidate->mission }}</td>
                                        <td>{{ $candidate->sort_order }}</td>
                                        <td>{{ $candidate->votes->count() }}</td>
                                        <td>
                                            @can('candidate-update')
                                                <a href="{{ route('app.candidate.edit', $candidate->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            <a href="{{ route('app.candidate.show', $candidate->id) }}"
                                                class="btn btn-info">Show</a>
                                            @can('candidate-delete')
                                                <button class="btn btn-danger"
                                                    onclick="confirmDelete({{ $candidate->id }}, '{{ $candidate->name }}')">
                                                    Delete
                                                </button>
                                                <form id="delete-form-{{ $candidate->id }}"
                                                    action="{{ route('app.candidate.destroy', $candidate->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
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

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="candidateName"></strong>? This action cannot be undone.
                    </p>
                    <input type="text" id="deleteConfirmInput" class="form-control"
                        placeholder="Type 'DELETE' to confirm">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton" disabled>Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let deleteForm;

        function confirmDelete(id, name) {
            deleteForm = document.getElementById(`delete-form-${id}`);
            document.getElementById('candidateName').innerText = name;
            $('#deleteConfirmInput').val('');
            $('#confirmDeleteButton').prop('disabled', true);
            $('#confirmDeleteModal').modal('show');
        }

        document.getElementById('deleteConfirmInput').addEventListener('input', function() {
            document.getElementById('confirmDeleteButton').disabled = this.value.trim().toUpperCase() !== 'DELETE';
        });

        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
@endsection
