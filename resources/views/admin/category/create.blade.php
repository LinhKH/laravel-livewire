@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> <a href="{{ url('admin/categories') }}" type="button"
                            class="btn btn-primary me-2 float-end">Back</a></h4><br />

                    <form class="forms-sample" method="POST" action="{{ route('categories.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Slug</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug">
                                     @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control @error('slug') is-invalid @enderror" name="description" rows="3" placeholder="Description"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="formFile">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Status</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="status" id="status" class="form-check-input">
                                    </label>
                                </div>
                                <span>(checked=hidden, uncheck=visible)</span>
                            </div>
                        </div>

                        <hr class="bg-danger border-2 border-top border-danger" />
                        <p class="card-description">SEO Tags</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Meta Title">
                                    @error('meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Meta Keyword</label>
                                    <input type="text" name="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror"
                                        placeholder="Meta Keyword">
                                        @error('meta_keyword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="2" placeholder="Meta Description"></textarea>
                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
