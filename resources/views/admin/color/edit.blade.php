@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> <a href="{{ url('admin/color') }}" type="button"
                            class="btn btn-primary me-2 float-end">Back</a></h4><br />

                    <form class="forms-sample" method="POST" action="{{ route('color.update', $color->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" name="name" value="{{ $color->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Code</label>
                                    <input type="text" name="code" value="{{ $color->code }}" class="form-control @error('code') is-invalid @enderror" placeholder="Code">
                                     @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Status</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="status" value="{{ $color->status }}" {{ $color->status == 1 ? 'checked' : '' }} id="status" class="form-check-input">
                                    </label>
                                </div>
                                <span>(checked=hidden, uncheck=visible)</span>
                            </div>

                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
