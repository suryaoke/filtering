@extends('layouts.app')

@section('title', 'Customer Management')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Customer Management
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <button onclick="createData()" class="btn btn-primary shadow-md mr-2">Add New Customer</button>
    </div>
</div>

<!-- BEGIN: HTML Table Data -->
<div class="intro-y box p-5 mt-5">
    <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
        <form id="filter-form" class="xl:flex sm:mr-auto">
            <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Search</label>
                <input id="filter-search" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Name, Email...">
            </div>
            <div class="mt-2 xl:mt-0">
                <button id="filter-submit" type="button" class="btn btn-primary w-full sm:w-16">Filter</button>
                <button id="filter-reset" type="button" class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1">Reset</button>
            </div>
        </form>
    </div>
    <div class="overflow-x-auto scrollbar-hidden">
        <table id="customers-table" class="table table-report mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">NAME</th>
                    <th class="whitespace-nowrap">EMAIL</th>
                    <th class="whitespace-nowrap">PHONE</th>
                    <th class="text-center whitespace-nowrap">CITY</th>
                    <th class="text-center whitespace-nowrap">GENDER</th>
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
                <h2 id="modal-title" class="font-medium text-base mr-auto">Add Customer</h2>
            </div>
            <form id="main-form">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input id="phone" name="phone" type="text" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" name="gender" class="form-select" style="width: 100%;">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-span-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="address" name="address" class="form-control" placeholder="Address" rows="3"></textarea>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="city" class="form-label">City</label>
                        <input id="city" name="city" type="text" class="form-control" placeholder="City">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="province" class="form-label">Province</label>
                        <input id="province" name="province" type="text" class="form-control" placeholder="Province">
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
                        Do you really want to delete this customer?
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

{{-- Select2 --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

<style>
    .table-report:not(.table-sm) thead th {
        border-bottom-width: 1px;
        padding-top: 1.25rem;
        padding-bottom: 1.25rem;
        background-color: transparent;
    }

    /* Sesuaikan tinggi Select2 dengan form-control */
    .select2-container .select2-selection--single {
        height: calc(1.5em + 0.75rem + 2px) !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 0.25rem !important;
        padding: 0.375rem 0.75rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
        padding-left: 0 !important;
        color: #374151;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
    }
</style>
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let table;
    let deleteId = null;

    $(function() {

        $("#gender").select2({
            placeholder: "Select Gender",
            allowClear: true,
            dropdownParent: $('#main-modal') // penting agar muncul di dalam modal
        });

     
        table = $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('customers.index') }}",
                data: function(d) {
                    d.search = $('#filter-search').val();
                }
            },
            columns: [{
                    data: 'name',
                    name: 'name',
                    render: function(data) {
                        return `<div class="font-medium whitespace-nowrap">${data}</div>`;
                    }
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'city',
                    name: 'city',
                    className: 'text-center'
                },
                {
                    data: 'gender',
                    name: 'gender',
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'w-56'
                }
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
        $('#modal-title').text('Add Customer');
        $('#main-form').attr('action', "{{ route('customers.store') }}");

        // Reset Select2
        $("#gender").val("").trigger("change");

        const el = document.querySelector("#main-modal");
        const modal = tailwind.Modal.getOrCreateInstance(el);
        modal.show();
    }

    
    function editData(id) {
        $.get(`/customers/${id}/edit`, function(data) {
            $('#main-form')[0].reset();
            $('#form-method').val('PUT');
            $('#modal-title').text('Edit Customer');
            $('#main-form').attr('action', `/customers/${id}`);

            // Populate field biasa
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
            $('#address').val(data.address);
            $('#city').val(data.city);
            $('#province').val(data.province);

            // Set value Select2
            $("#gender").val(data.gender).trigger("change");

            const el = document.querySelector("#main-modal");
            const modal = tailwind.Modal.getOrCreateInstance(el);
            modal.show();
        }).fail(function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to load customer data.'
            });
        });
    }

   
    function saveData() {
        const form = $('#main-form');
        const url = form.attr('action');
        const method = $('#form-method').val();

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(), // Select2 otomatis ter-serialize
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

                if (xhr.responseJSON && xhr.responseJSON.errors) {
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
        if (!deleteId) return;

        $.ajax({
            url: `/customers/${deleteId}`,
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
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to delete customer.'
                });
            }
        });
    }
</script>
@endpush