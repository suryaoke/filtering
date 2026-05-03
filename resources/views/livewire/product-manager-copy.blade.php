<div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Product Management (Livewire)
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button wire:click="create" class="btn btn-primary shadow-md mr-2">Add New Product</button>
        </div>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start mb-5">
            <div class="xl:flex sm:mr-auto">
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Search</label>
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Name, SKU, Category...">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto scrollbar-hidden">
            <table class="table table-report mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">PRODUCT NAME</th>
                        <th class="whitespace-nowrap">SKU</th>
                        <th class="whitespace-nowrap">CATEGORY</th>
                        <th class="text-center whitespace-nowrap">PRICE</th>
                        <th class="text-center whitespace-nowrap">STOCK</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="intro-x">
                        <td>
                            <div class="font-medium whitespace-nowrap">{{ $product->name }}</div>
                        </td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->category }}</td>
                        <td class="text-center">${{ number_format($product->price, 2) }}</td>
                        <td class="text-center">{{ $product->stock }}</td>
                        <td class="text-center">
                            @if($product->is_active)
                                <span class="text-success font-medium">Active</span>
                            @else
                                <span class="text-danger font-medium">Inactive</span>
                            @endif
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <button wire:click="edit({{ $product->id }})" class="flex items-center mr-3">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </button>
                                <button wire:click="confirmDelete({{ $product->id }})" class="flex items-center text-danger">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Add/Edit Modal -->
    @if($isOpen)
    <div class="modal overflow-y-auto show" tabindex="-1" aria-hidden="false" style="margin-top: 0px; margin-left: 0px; padding-left: 0px; z-index: 10000;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">{{ $productId ? 'Edit Product' : 'Add Product' }}</h2>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-8">
                            <label class="form-label">Product Name</label>
                            <input wire:model="name" type="text" class="form-control" placeholder="Product Name">
                            @error('name') <span class="text-danger mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-4">
                            <label class="form-label">SKU</label>
                            <input wire:model="sku" type="text" class="form-control" placeholder="SKU">
                            @error('sku') <span class="text-danger mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12">
                            <label class="form-label">Description</label>
                            <textarea wire:model="description" class="form-control" placeholder="Product Description" rows="3"></textarea>
                            @error('description') <span class="text-danger mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Price</label>
                            <input wire:model="price" type="number" step="0.01" class="form-control" placeholder="0.00">
                            @error('price') <span class="text-danger mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Stock</label>
                            <input wire:model="stock" type="number" class="form-control" placeholder="0">
                            @error('stock') <span class="text-danger mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Category</label>
                            <input wire:model="category" type="text" class="form-control" placeholder="Category">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label class="form-label">Status</label>
                            <select wire:model="is_active" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-primary w-20">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-backdrop show" style="z-index: 9999;"></div>
    @endif

    <!-- Delete Modal -->
    @if($isDeleteOpen)
    <div class="modal overflow-y-auto show" tabindex="-1" aria-hidden="false" style="margin-top: 0px; margin-left: 0px; padding-left: 0px; z-index: 10000;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete this product?</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" wire:click="closeDeleteModal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="button" wire:click="delete" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop show" style="z-index: 9999;"></div>
    @endif

    @script
    <script>
        $wire.on('swal:success', (event) => {
            const data = Array.isArray(event) ? event[0] : event;
            Swal.fire({
                title: data.title,
                text: data.text,
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        });
    </script>
    @endscript
</div>
