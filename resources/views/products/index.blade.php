@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Product Management
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button onclick="createData()" class="btn btn-primary shadow-md mr-2">Add New Product</button>
        </div>
    </div>

    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form id="filter-form" class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Search</label>
                    <input id="filter-search" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Name, SKU...">
                </div>
                <div class="mt-2 xl:mt-0">
                    <button id="filter-submit" type="button" class="btn btn-primary w-full sm:w-16" >Filter</button>
                    <button id="filter-reset" type="button" class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1" >Reset</button>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto scrollbar-hidden">
            <table id="products-table" class="table table-report mt-2">
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
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: HTML Table Data -->

    <!-- BEGIN: Main Modal (Add/Edit) -->
    <div id="main-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modal-title" class="font-medium text-base mr-auto">Add Product</h2>
                </div>
                <form id="main-form">
                    @csrf
                    <input type="hidden" name="_method" id="form-method" value="POST">
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-8">
                            <label for="name" class="form-label">Product Name</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Product Name" required>
                        </div>
                        <div class="col-span-12 sm:col-span-4">
                            <label for="sku" class="form-label">SKU</label>
                            <input id="sku" name="sku" type="text" class="form-control" placeholder="SKU" required>
                        </div>
                        <div class="col-span-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Product Description" rows="3"></textarea>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="price" class="form-label">Price</label>
                            <input id="price" name="price" type="number" step="0.01" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="stock" class="form-label">Stock</label>
                            <input id="stock" name="stock" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="category" class="form-label">Category</label>
                            <input id="category" name="category" type="text" class="form-control" placeholder="Category">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="is_active" class="form-label">Status</label>
                            <select id="is_active" name="is_active" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-primary w-20">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Main Modal -->

    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete this product? 
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="button" onclick="executeDelete()" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <style>
        .table-report:not(.table-sm) thead th {
            border-bottom-width: 1px;
            padding-top: 1.25rem;
            padding-bottom: 1.25rem;
            background-color: transparent;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        let table;
        let deleteId = null;

        $(function() {
            table = $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('products.index') }}",
                    data: function (d) {
                        d.search = $('#filter-search').val();
                    }
                },
                columns: [
                    { data: 'name', name: 'name', render: function(data, type, row) {
                        return `<div class="font-medium whitespace-nowrap">${data}</div>`;
                    }},
                    { data: 'sku', name: 'sku' },
                    { data: 'category', name: 'category' },
                    { data: 'price', name: 'price', className: 'text-center' },
                    { data: 'stock', name: 'stock', className: 'text-center' },
                    { data: 'is_active', name: 'is_active', className: 'text-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'w-56' }
                ],
                dom: '<"top"rt><"bottom"ip><"clear">',
                language: {
                    paginate: {
                        previous: '<i class="w-4 h-4" data-lucide="chevron-left"></i>',
                        next: '<i class="w-4 h-4" data-lucide="chevron-right"></i>'
                    }
                },
                drawCallback: function() {
                    lucide.createIcons({
                        icons: lucide.icons,
                        "stroke-width": 1.5,
                        nameAttr: "data-lucide"
                    });
                }
            });

            $('#filter-submit').on('click', function() {
                table.draw();
            });

            $('#filter-reset').on('click', function() {
                $('#filter-search').val('');
                table.draw();
            });

            $('#main-form').on('submit', function(e) {
                e.preventDefault();
                saveData();
            });
        });

        function createData() {
            $('#main-form')[0].reset();
            $('#form-method').val('POST');
            $('#modal-title').text('Add Product');
            $('#main-form').attr('action', "{{ route('products.store') }}");
            
            const el = document.querySelector("#main-modal");
            const modal = tailwind.Modal.getOrCreateInstance(el);
            modal.show();
        }

        function editData(id) {
            $.get(`/products/${id}/edit`, function(data) {
                $('#main-form')[0].reset();
                $('#form-method').val('PUT');
                $('#modal-title').text('Edit Product');
                $('#main-form').attr('action', `/products/${id}`);
                
                // Populate fields
                $('#name').val(data.name);
                $('#sku').val(data.sku);
                $('#description').val(data.description);
                $('#price').val(data.price);
                $('#stock').val(data.stock);
                $('#category').val(data.category);
                $('#is_active').val(data.is_active);

                const el = document.querySelector("#main-modal");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            });
        }

        function saveData() {
            const form = $('#main-form');
            const url = form.attr('action');
            const data = form.serialize();

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(response) {
                    const el = document.querySelector("#main-modal");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.hide();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                    
                    table.draw();
                },
                error: function(xhr) {
                    let errorMessage = 'Something went wrong.';
                    if(xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorMessage
                    });
                }
            });
        }

        function confirmDelete(id) {
            deleteId = id;
            const el = document.querySelector("#delete-confirmation-modal");
            const modal = tailwind.Modal.getOrCreateInstance(el);
            modal.show();
        }

        function executeDelete() {
            if(!deleteId) return;
            
            $.ajax({
                url: `/products/${deleteId}`,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    const el = document.querySelector("#delete-confirmation-modal");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.hide();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted',
                        text: response.message
                    });
                    
                    table.draw();
                    deleteId = null;
                }
            });
        }
    </script>
@endpush
