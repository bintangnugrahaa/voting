@extends('layouts.app')

@section('title', 'Voter')

@section('content')
    <div class="row">

        @can('voter-create')
            <div class="col-md-12">
                <a href="{{ route('app.voter.create') }}" class="btn btn-primary mb-3">Add Voter</a>
            </div>
        @endcan

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Voter</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($voters as $voter)
                                    <tr>
                                        <td>{{ $voter->name }}</td>
                                        <td>{{ $voter->user->email }}</td>
                                        <td>
                                            @can('voter-update')
                                                <a href="{{ route('app.voter.edit', $voter->id) }}" class="btn btn-warning">Edit</a>
                                            @endcan

                                            <a href="{{ route('app.voter.show', $voter->id) }}" class="btn btn-info">Show</a>

                                            @can('voter-delete')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDeletion({{ $voter->id }}, '{{ $voter->name }}')">
                                                    Delete
                                                </button>
                                                <form id="delete-form-{{ $voter->id }}"
                                                    action="{{ route('app.voter.destroy', $voter->id) }}" method="POST"
                                                    class="d-none">
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

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="voterName"></strong>? This action cannot be undone.</p>
                    <input type="text" id="deleteConfirmationInput" class="form-control"
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
        let deleteVoterId = null;

        function confirmDeletion(voterId, voterName) {
            deleteVoterId = voterId;
            $('#deleteConfirmationInput').val('');
            $('#confirmDeleteButton').prop('disabled', true);
            $('#voterName').text(voterName); // Update nama voter dalam modal
            $('#confirmDeleteModal').modal('show');
        }

        $(document).ready(function() {
            $('#dataTable').DataTable();

            $('#deleteConfirmationInput').on('input', function() {
                $('#confirmDeleteButton').prop('disabled', $(this).val().trim().toUpperCase() !== 'DELETE');
            });

            $('#confirmDeleteButton').click(function() {
                if (deleteVoterId) {
                    $('#delete-form-' + deleteVoterId).submit();
                }
            });
        });
    </script>
@endsection
