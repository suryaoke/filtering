@extends('layouts.app')

@section('title', 'Sales Data')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Sales Data
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button onclick="createData()" class="btn btn-primary shadow-md mr-2">Add New Sale</button>
            <div class="dropdown ml-auto sm:ml-0">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export Excel </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form id="filter-form" class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Search</label>
                    <input id="filter-search" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                </div>
                <div class="mt-2 xl:mt-0">
                    <button id="filter-submit" type="button" class="btn btn-primary w-full sm:w-16" >Filter</button>
                    <button id="filter-reset" type="button" class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1" >Reset</button>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto scrollbar-hidden">
            <table id="sales-table" class="table table-report mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">COMPANY</th>
                        <th class="whitespace-nowrap">CONTACT</th>
                        <th class="whitespace-nowrap">INDUSTRY</th>
                        <th class="text-center whitespace-nowrap">DATE</th>
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
                    <h2 id="modal-title" class="font-medium text-base mr-auto">Add Sale</h2>
                </div>
                <form id="main-form">
                    @csrf
                    <input type="hidden" name="_method" id="form-method" value="POST">
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12">
                            <label for="product_id" class="form-label">Product</label>
                            <select id="product_id" name="product_id" class="form-select" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input id="company_name" name="company_name" type="text" class="form-control" placeholder="Company Name" required>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="contact_name" class="form-label">Contact Name</label>
                            <input id="contact_name" name="contact_name" type="text" class="form-control" placeholder="Contact Name" required>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input id="phone" name="phone" type="text" class="form-control" placeholder="Phone">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="industry" class="form-label">Industry</label>
                            <input id="industry" name="industry" type="text" class="form-control" placeholder="Industry">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="source" class="form-label">Source</label>
                            <input id="source" name="source" type="text" class="form-control" placeholder="Source">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="user_id" class="form-label">Sales Representative</label>
                            <select id="user_id" name="user_id" class="form-select">
                                <option value="">Select Sales</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12">
                            <label for="input_date" class="form-label">Input Date</label>
                            <input id="input_date" name="input_date" type="date" class="form-control">
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

    <!-- BEGIN: Detail Modal -->
    <div id="detail-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Sale Details</h2>
                </div>
                <div class="modal-body p-5">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <div class="text-slate-500 text-xs">Product</div>
                            <div id="detail-product" class="mt-1 font-medium">-</div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="text-slate-500 text-xs">Company</div>
                            <div id="detail-company" class="mt-1 font-medium">-</div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="text-slate-500 text-xs">Contact</div>
                            <div id="detail-contact" class="mt-1 font-medium">-</div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="text-slate-500 text-xs">Email</div>
                            <div id="detail-email" class="mt-1 font-medium">-</div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="text-slate-500 text-xs">Phone</div>
                            <div id="detail-phone" class="mt-1 font-medium">-</div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="text-slate-500 text-xs">Industry</div>
                            <div id="detail-industry" class="mt-1 font-medium">-</div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="text-slate-500 text-xs">Sales</div>
                            <div id="detail-sales" class="mt-1 font-medium">-</div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="text-slate-500 text-xs">Date</div>
                            <div id="detail-date" class="mt-1 font-medium">-</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Detail Modal -->

    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete <strong id="delete-name"></strong>? 
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
        .badge-pending { background-color: #f1f5f9; color: #475569; padding: 0.25rem 0.5rem; border-radius: 0.25rem; }
        .badge-success { background-color: rgba(34, 197, 94, 0.2); color: #16a34a; padding: 0.25rem 0.5rem; border-radius: 0.25rem; }
        .badge-danger { background-color: rgba(239, 68, 68, 0.2); color: #dc2626; padding: 0.25rem 0.5rem; border-radius: 0.25rem; }
        .badge-primary { background-color: rgba(59, 130, 246, 0.2); color: #2563eb; padding: 0.25rem 0.5rem; border-radius: 0.25rem; }
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
            table = $('#sales-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('sales.index') }}",
                    data: function (d) {
                        d.status = $('#filter-status').val();
                        d.search = $('#filter-search').val();
                    }
                },
                columns: [
                    { data: 'company_name', name: 'company_name' },
                    { 
                        data: 'contact_name', 
                        name: 'contact_name',
                        render: function(data, type, row) {
                            return `<div class="font-medium whitespace-nowrap">${data}</div>
                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">${row.email}</div>`;
                        }
                    },
                    { data: 'industry', name: 'industry' },
                    { data: 'input_date', name: 'input_date', className: 'text-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                dom: '<"top"rt><"bottom"ip><"clear">',
                language: {
                    paginate: {
                        previous: '<i class="w-4 h-4" data-lucide="chevron-left"></i>',
                        next: '<i class="w-4 h-4" data-lucide="chevron-right"></i>'
                    }
                },
                drawCallback: function() {
                    lucide.createIcons();
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
            $('#modal-title').text('Add Sale');
            $('#main-form').attr('action', "{{ route('sales.store') }}");
            
            const el = document.querySelector("#main-modal");
            const modal = tailwind.Modal.getOrCreateInstance(el);
            modal.show();
        }

        function editData(id) {
            $.get(`/sales/${id}/edit`, function(data) {
                $('#main-form')[0].reset();
                $('#form-method').val('PUT');
                $('#modal-title').text('Edit Sale');
                $('#main-form').attr('action', `/sales/${id}`);
                
                // Populate fields
                $('#product_id').val(data.product_id);
                $('#company_name').val(data.company_name);
                $('#contact_name').val(data.contact_name);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#industry').val(data.industry);
                $('#source').val(data.source);
                $('#user_id').val(data.user_id);
                
                if(data.input_date) {
                    const date = new Date(data.input_date);
                    $('#input_date').val(date.toISOString().split('T')[0]);
                }

                const el = document.querySelector("#main-modal");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            });
        }

        function showData(id) {
            $.get(`/sales/${id}`, function(data) {
                $('#detail-product').text(data.product ? data.product.name : '-');
                $('#detail-company').text(data.company_name);
                $('#detail-contact').text(data.contact_name);
                $('#detail-email').text(data.email || '-');
                $('#detail-phone').text(data.phone || '-');
                $('#detail-industry').text(data.industry || '-');
                $('#detail-sales').text(data.user ? data.user.name : '-');
                $('#detail-date').text(data.input_date ? new Date(data.input_date).toLocaleDateString() : '-');

                const el = document.querySelector("#detail-modal");
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
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorMessage
                    });
                }
            });
        }

        function confirmDelete(id, name) {
            deleteId = id;
            $('#delete-name').text(name);
            const el = document.querySelector("#delete-confirmation-modal");
            const modal = tailwind.Modal.getOrCreateInstance(el);
            modal.show();
        }

        function executeDelete() {
            if(!deleteId) return;
            
            $.ajax({
                url: `/sales/${deleteId}`,
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
