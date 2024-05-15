@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> <a href="{{ url('admin/categories') }}" type="button"
                            class="btn btn-primary me-2 float-end">Back</a></h4><br />

                    <form class="forms-sample" action="{{ url('/admin/categories/' . $category->id . '/edit') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" name="name" value="{{ $category->name }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name">
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
                                    <input type="text" name="slug" value="{{ $category->slug }}"
                                        class="form-control @error('slug') is-invalid @enderror" placeholder="Slug">
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
                                    <textarea value="{{ $category->description }}" class="form-control @error('slug') is-invalid @enderror"
                                        name="description" rows="3" placeholder="Description">{{ $category->description }}</textarea>
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
                                    <input class="form-control mb-3 @error('image') is-invalid @enderror" name="image"
                                        type="file" id="formFile">
                                    <img src="{{ asset($category->image) }}" width="60"
                                        height="60" />
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
                                        <input type="checkbox" name="status"
                                            {{ $category->status == '1' ? 'checked' : '' }} id="status"
                                            class="form-check-input">
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
                                    <input type="text" value="{{ $category->meta_title }}" name="meta_title"
                                        class="form-control @error('meta_title') is-invalid @enderror"
                                        placeholder="Meta Title">
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
                                    <input type="text" value="{{ $category->meta_keyword }}" name="meta_keyword"
                                        class="form-control @error('meta_keyword') is-invalid @enderror"
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
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                        value="{{ $category->meta_description }}" name="meta_description" rows="2" placeholder="Meta Description">{{ $category->meta_description }}</textarea>
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
