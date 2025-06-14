@extends('layouts.app')

@section('title', 'Candidate Edit')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('app.candidate.index') }}" class="btn btn-danger">Back</a>
        </div>

        <div class="col-md-12">
            @include('includes.alert')
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Candidate</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('app.candidate.update', $candidate->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $candidate->name) }}" placeholder="Enter name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="chairman">Chairman</label>
                                <input type="text" name="chairman" id="chairman"
                                    class="form-control @error('chairman') is-invalid @enderror"
                                    value="{{ old('chairman', $candidate->chairman) }}" placeholder="Enter chairman">
                                @error('chairman')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="vice_chairman">Vice Chairman</label>
                                <input type="text" name="vice_chairman" id="vice_chairman"
                                    class="form-control @error('vice_chairman') is-invalid @enderror"
                                    value="{{ old('vice_chairman', $candidate->vice_chairman) }}"
                                    placeholder="Enter vice chairman">
                                @error('vice_chairman')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="vision">Vision</label>
                                <input type="text" name="vision" id="vision"
                                    class="form-control @error('vision') is-invalid @enderror"
                                    value="{{ old('vision', $candidate->vision) }}" placeholder="Enter vision">
                                @error('vision')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mission">Mission</label>
                                <input type="text" name="mission" id="mission"
                                    class="form-control @error('mission') is-invalid @enderror"
                                    value="{{ old('mission', $candidate->mission) }}" placeholder="Enter mission">
                                @error('mission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="text" name="sort_order" id="sort_order"
                                class="form-control @error('sort_order') is-invalid @enderror"
                                value="{{ old('sort_order', $candidate->sort_order) }}" placeholder="Enter sort order">
                            @error('sort_order')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Candidate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
