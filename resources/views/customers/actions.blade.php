<div class="flex justify-center items-center">
    <a class="flex items-center mr-3" href="javascript:;" onclick="editData({{ $row->id }})">
        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
    </a>
    <a class="flex items-center text-danger" href="javascript:;" onclick="confirmDelete({{ $row->id }})">
        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
    </a>
</div>
