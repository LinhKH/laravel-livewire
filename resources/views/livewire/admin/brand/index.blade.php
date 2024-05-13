<div class="row">
    <div class="card">

        <div class="card-body">
            <h4 class="card-title float-end"><a href="" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addBrandModal">Add Brand</a></h4><br />
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
                                Category
                            </th>
                            <th>
                                Slug
                            </th>
                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <td>
                                    {{ $brand->id }}
                                </td>
                                <td>
                                    {{ $brand->name }}
                                </td>
                                <td>
                                    {{ $brand->category?->name }}
                                </td>
                                <td>
                                    {{ $brand->slug }}
                                </td>
                                <td>
                                    @if ( $brand->status == 1)
                                    <span class="badge rounded-pill bg-primary">Hidden</span>
                                    @else
                                    <span class="badge rounded-pill bg-warning text-dark">Visible</span>
                                        
                                    @endif

                                </td>

                                <td>
                                    <a wire:click="editBrand({{ $brand->id }})" href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateBrandModal"><i
                                        class="fa fa-edit"></i></a>
                                    <a wire:click="deleteBrand({{ $brand->id }})" class="btn btn-danger" href=""
                                        data-bs-toggle="modal" data-bs-target="#confirmDelete"><i
                                            class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">No data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{ $brands->links() }}
            </div>
        </div>
    </div>
    @include('livewire.admin.brand.modal-form')
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', (event) => {
            $("#addBrandModal").modal('hide');
            $("#updateBrandModal").modal('hide');
            $("#confirmDelete").modal('hide');
        })
    </script>
@endpush
