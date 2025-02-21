@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="row">

        @can('user-create')
            <div class="col-md-12">
                <a href="{{ route('app.user.create') }}" class="btn btn-primary mb-3">Add User</a>
            </div>
        @endcan

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->name }}</td>
                                        <td>
                                            @can('user-update')
                                                <a href="{{ route('app.user.edit', $user->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan

                                            <a href="{{ route('app.user.show', $user->id) }}" class="btn btn-info">Show</a>

                                            @can('user-delete')
                                                <button class="btn btn-danger"
                                                    onclick="confirmDelete({{ $user->id }}, '{{ $user->email }}')">Delete</button>
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('app.user.destroy', $user->id) }}" method="POST"
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

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteUserEmail"></strong>? This action cannot be undone.
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

        function confirmDelete(id, email) {
            deleteForm = document.getElementById(`delete-form-${id}`);
            document.getElementById('deleteUserEmail').textContent = email;
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

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
