<?php

namespace App\Livewire;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class ProductManager extends Component
{
    use WithPagination;

    public $search = '';
    public $productId;
    public $name, $sku, $description, $price, $stock, $category, $is_active = 1;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $confirmingDeletionId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'sku' => 'required|string|max:100',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category' => 'nullable|string|max:100',
        'is_active' => 'boolean',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $repository = app(ProductRepositoryInterface::class);
        $products = $repository->getAllPaginated(10, [
            'search' => $this->search
        ]);

        return view('livewire.product-manager', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->dispatch('open-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->sku = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->category = '';
        $this->is_active = 1;
        $this->productId = null;
    }

    public function store()
    {
        $this->validate(array_merge($this->rules, [
            'sku' => 'required|string|max:100|unique:products,sku,' . $this->productId
        ]));

        $repository = app(ProductRepositoryInterface::class);
        $data = [
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category' => $this->category,
            'is_active' => $this->is_active,
        ];

        if ($this->productId) {
            $repository->update($this->productId, $data);
            $message = 'Product updated successfully.';
        } else {
            $repository->create($data);
            $message = 'Product created successfully.';
        }

        $this->closeModal();
        $this->resetInputFields();
        
        $this->dispatch('swal:success', [
            'title' => 'Success',
            'text' => $message
        ]);
    }

    public function edit($id)
    {
        $repository = app(ProductRepositoryInterface::class);
        $product = $repository->findOrFail($id);
        
        $this->productId = $id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category = $product->category;
        $this->is_active = $product->is_active ? 1 : 0;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeletionId = $id;
        $this->dispatch('open-delete-modal');
    }

    public function delete()
    {
        $repository = app(ProductRepositoryInterface::class);
        $repository->delete($this->confirmingDeletionId);
        
        $this->dispatch('close-delete-modal');
        $this->dispatch('swal:success', [
            'title' => 'Deleted',
            'text' => 'Product deleted successfully.'
        ]);
    }
}
