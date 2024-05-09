<div class="row">
    <div class="card">

        <div class="card-body">
            <h4 class="card-title"> <a href="{{ url('admin/category/create') }}" type="button"
                    class="btn btn-primary me-2 float-end">Add Category</a></h4><br />
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Image
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->id }}
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    {{ $category->status == '1' ? 'Hidden' : 'Visible' }}
                                </td>
                                <td>
                                    <img src="{{ asset('uploads/category') . '/' . $category->image }}" />
                                </td>
                                <td>
                                    <a href="{{ url('/admin/category/' . $category->id . '/edit') }}"><i
                                            class="fa fa-edit"></i></a>
                                    <a wire:click="deleteCategory({{ $category->id }})" href="" data-bs-toggle="modal" data-bs-target="#confirmDelete"><i
                                            class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="destroyCategory">
                    <div class="modal-body">
                        <p>Are you sure to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes. Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', (event) => {
            $("#confirmDelete").modal('hide'); 
        })
    </script>
@endpush
