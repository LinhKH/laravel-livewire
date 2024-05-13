<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="storeBrand">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category" class="col-form-label">Category:</label>
                        <select wire:model.defer='category_id' class="form-control">
                            <option value="">Select one</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" wire:model.defer='name' class="form-control" id="name"
                            name="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="col-form-label">Slug:</label>
                        <input type="text" wire:model.defer='slug' class="form-control" id="slug"
                            name="slug">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="col-form-label">Status:</label>
                        <input type="checkbox" wire:model.defer='status'>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
                <button wire:click="closeModal" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category" class="col-form-label">Category:</label>
                            <select wire:model.defer='category_id' class="form-control">
                                <option value="">Select one</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" wire:model.defer='name' class="form-control" id="name"
                                name="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="col-form-label">Slug:</label>
                            <input type="text" wire:model.defer='slug' class="form-control" id="slug"
                                name="slug">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">

                            <label for="slug" class="col-form-label">Status:</label>
                            <input name="status" type="checkbox" wire:model.defer='status'>
    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="closeModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Brand</h5>
                <button wire:click="closeModal" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyBrand">
                    <div class="modal-body">
                        <p>Are you sure to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="closeModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes. Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
