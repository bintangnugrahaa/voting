@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('app.role.index') }}" class="btn btn-danger">Back</a>
        </div>

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Role</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('app.role.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $role->name) }}" placeholder="Enter role name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="permission">Permissions</label>
                            <select name="permission[]" id="permission"
                                class="form-control select2 @error('permission') is-invalid @enderror" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}"
                                        @if (in_array($permission->name, $role->permissions->pluck('name')->toArray())) selected @endif>
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('permission')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#permission').select2({
                placeholder: "Select permissions",
                allowClear: true
            });
        });
    </script>
@endsection
